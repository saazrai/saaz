<?php

namespace App\Http\Controllers\Assessments;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Diagnostic;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticResponse;
use App\Services\AdaptiveDiagnosticService;
use App\Services\UserAbilityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiagnosticController extends Controller
{
    const MIN_QUESTIONS_PER_DOMAIN = 5;

    const MAX_QUESTIONS_PER_DOMAIN = 12;

    protected UserAbilityService $abilityService;

    protected AdaptiveDiagnosticService $adaptiveService;

    public function __construct(
        UserAbilityService $abilityService,
        AdaptiveDiagnosticService $adaptiveService
    ) {
        $this->middleware('auth')->except(['index', 'sample']);
        $this->abilityService = $abilityService;
        $this->adaptiveService = $adaptiveService;
    }

    /**
     * Display sample diagnostic without authentication.
     */
    public function sample(): Response
    {
        return Inertia::render('Diagnostics/SampleQuiz', [
            'isAuthenticated' => auth()->check(),
            'user' => auth()->user(),
        ]);
    }

    /**
     * Display available diagnostics.
     */
    public function index(Request $request): Response
    {
        $isAuthenticated = auth()->check();

        if ($isAuthenticated) {
            // Get user diagnostics
            $userDiagnostics = Diagnostic::where('user_id', auth()->id())
                ->with('responses')
                ->latest()
                ->get();

            $diagnosticsHistory = $userDiagnostics;

            // Check if user has a completed diagnostic
            $hasCompletedDiagnostic = $userDiagnostics->where('status', 'completed')->isNotEmpty();

            // Check if user has an in-progress diagnostic
            $inProgressDiagnostic = $userDiagnostics->where('status', 'in_progress')->first();
        } else {
            // Guest user - no history
            $diagnosticsHistory = collect([]);
            $hasCompletedDiagnostic = false;
            $inProgressDiagnostic = null;
        }

        return Inertia::render('Diagnostics/Index', [
            'diagnosticsHistory' => $diagnosticsHistory,
            'hasCompletedDiagnostic' => $hasCompletedDiagnostic,
            'inProgressDiagnostic' => $inProgressDiagnostic,
            'totalQuestions' => 100, // Adaptive - will vary
            'isAuthenticated' => $isAuthenticated,
            'encourageSignup' => ! $isAuthenticated,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Start a diagnostic assessment.
     */
    public function start(Request $request): Response|RedirectResponse
    {
        // Check if a specific phase is requested (now from POST body)
        $requestedPhase = $request->input('phase');

        if ($requestedPhase) {
            // Validate phase number
            if (! in_array($requestedPhase, [1, 2, 3, 4])) {
                return redirect()->route('assessments.diagnostics.all-results')
                    ->with('error', 'Invalid phase number.');
            }

            // Check if user can start this phase (previous phases must be completed)
            if ($requestedPhase > 1) {
                $previousPhaseCompleted = Diagnostic::where('user_id', auth()->id())
                    ->where('status', 'completed')
                    ->whereHas('phase', function ($query) use ($requestedPhase) {
                        $query->where('order_sequence', $requestedPhase - 1);
                    })
                    ->exists();

                if (! $previousPhaseCompleted) {
                    return redirect()->route('assessments.diagnostics.all-results')
                        ->with('error', 'You must complete Phase '.($requestedPhase - 1).' before starting Phase '.$requestedPhase.'.');
                }
            }

            // Start the diagnostic for the requested phase
            $request->merge(['target_phase' => $requestedPhase]);

            return $this->begin($request);
        }

        // Original behavior for backward compatibility
        $assessment = Assessment::create([
            'user_id' => auth()->id(),
            'assessable_type' => 'diagnostic',
            'assessable_id' => 1, // Default diagnostic
            'type' => 'diagnostic',
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return Inertia::render('Diagnostics/Assessment', [
            'assessment' => $assessment,
            'isAuthenticated' => true,
        ]);
    }

    /**
     * Begin diagnostic assessment.
     */
    public function begin(Request $request): RedirectResponse
    {
        // Step 2: Check if there's an existing in-progress diagnostic
        $existingDiagnostic = Diagnostic::where('user_id', auth()->id())
            ->where('status', 'in_progress')
            ->first();

        // Step 3: If existing diagnostic found, continue it
        if ($existingDiagnostic) {
            return redirect()->route('assessments.diagnostics.show', $existingDiagnostic);
        }

        // Step 4: Determine which phase to start
        // Check if user wants to continue from a specific diagnostic
        $continueFromDiagnostic = $request->input('continue_from_diagnostic');
        $targetPhaseId = null;

        if ($continueFromDiagnostic) {
            // User clicked "Start Phase X" from results page
            $previousDiagnostic = Diagnostic::where('id', $continueFromDiagnostic)
                ->where('user_id', auth()->id())
                ->first();

            if ($previousDiagnostic && $previousDiagnostic->phase) {
                // Get the next phase
                $nextPhase = \App\Models\DiagnosticPhase::where('order_sequence', '>', $previousDiagnostic->phase->order_sequence)
                    ->where('is_active', true)
                    ->orderBy('order_sequence')
                    ->first();

                if ($nextPhase) {
                    $targetPhaseId = $nextPhase->id;
                }
            }
        }

        // Check if a target phase was specified in the request
        $targetPhase = $request->input('target_phase');
        if ($targetPhase) {
            $phase = \App\Models\DiagnosticPhase::where('order_sequence', $targetPhase)
                ->where('is_active', true)
                ->first();
            if ($phase) {
                $targetPhaseId = $phase->id;
            }
        }

        // If no specific phase requested, auto-determine based on completed phases
        if (! $targetPhaseId) {
            // Get all completed diagnostics for this user
            $completedPhases = Diagnostic::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->with('phase')
                ->get()
                ->pluck('phase.order_sequence')
                ->filter()
                ->unique()
                ->sort()
                ->values();

            // Find the next uncompleted phase
            $nextPhaseOrder = 1;
            for ($i = 1; $i <= 4; $i++) {
                if (! $completedPhases->contains($i)) {
                    $nextPhaseOrder = $i;
                    break;
                }
            }

            $targetPhase = \App\Models\DiagnosticPhase::where('order_sequence', $nextPhaseOrder)
                ->where('is_active', true)
                ->first();

            if ($targetPhase) {
                $targetPhaseId = $targetPhase->id;
            }
        }

        // Fallback to first phase if something goes wrong
        if (! $targetPhaseId) {
            $firstPhase = \App\Models\DiagnosticPhase::where('is_active', true)
                ->orderBy('order_sequence')
                ->first();

            if (! $firstPhase) {
                return redirect()->route('assessments.diagnostics.index')
                    ->with('error', 'Diagnostic phases not configured. Please contact support.');
            }

            $targetPhaseId = $firstPhase->id;
        }

        $diagnostic = Diagnostic::create([
            'user_id' => auth()->id(),
            'status' => 'in_progress',
            'phase_id' => $targetPhaseId,
            'adaptive_state' => json_encode($this->adaptiveService->initializeTest([
                'question_count' => 100,
            ])),
        ]);

        // Step 5: Generate first question (simplified without AdaptiveService)
        $this->generateFirstQuestion($diagnostic);

        // Redirect to the diagnostic show page
        return redirect()->route('assessments.diagnostics.show', $diagnostic);
    }

    /**
     * Get the current domain name based on phase
     */
    private function getCurrentDomainName(int $phase): string
    {
        $phaseModel = \App\Models\DiagnosticPhase::where('order_sequence', $phase)->first();

        return $phaseModel ? $phaseModel->name : 'Foundation & Governance';
    }

    /**
     * Calculate domain-based progress according to business logic:
     * - 5 domains = 100% (each domain = 20%)
     * - Each question = 2% within domain
     * - Cap at 18% until domain complete, then 20%
     */
    private function calculateProgress(Diagnostic $diagnostic): int
    {
        $currentPhase = $diagnostic->phase;
        if (!$currentPhase || $currentPhase->domains->isEmpty()) {
            return 0;
        }

        // Validate expected domain count for business logic consistency
        $expectedDomains = 5;
        if ($currentPhase->domains->count() !== $expectedDomains) {
            \Log::warning('Domain count mismatch in progress calculation', [
                'diagnostic_id' => $diagnostic->id,
                'phase_id' => $currentPhase->id,
                'expected_domains' => $expectedDomains,
                'actual_domains' => $currentPhase->domains->count(),
            ]);
        }

        // Parse adaptive state once for efficiency
        $adaptiveState = json_decode($diagnostic->adaptive_state, true) ?? [];
        
        // Pre-load all diagnostic responses with domain information to avoid N+1 queries
        $responsesByDomain = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
            ->whereNotNull('user_answer')
            ->with('diagnosticItem.subtopic.topic.domain')
            ->get()
            ->groupBy(function ($response) {
                return $response->diagnosticItem?->subtopic?->topic?->domain?->id;
            });

        $totalProgress = 0.0;
        $domainProgressDetails = [];
        
        foreach ($currentPhase->domains as $domain) {
            $domainProgress = $this->calculateDomainProgress(
                $domain,
                $responsesByDomain->get($domain->id, collect()),
                $adaptiveState
            );
            
            $totalProgress += $domainProgress;
            $domainProgressDetails[] = [
                'domain_id' => $domain->id,
                'domain_name' => $domain->name,
                'progress' => $domainProgress,
            ];
        }

        // Apply bounds checking
        $finalProgress = max(0, min(100, round($totalProgress)));

        \Log::info('Domain-based Progress Calculation', [
            'diagnostic_id' => $diagnostic->id,
            'phase_id' => $currentPhase->id,
            'domain_details' => $domainProgressDetails,
            'total_progress' => $totalProgress,
            'final_progress' => $finalProgress,
        ]);

        return $finalProgress;
    }

    /**
     * Calculate progress for a specific domain using pre-loaded data:
     * - Each question = 2% of domain progress
     * - Cap at 18% until domain is complete
     * - Full 20% when domain is marked complete by adaptive service
     */
    private function calculateDomainProgress(
        $domain,
        $domainResponses,
        array $adaptiveState
    ): float {
        $questionsAnswered = $domainResponses->count();
        
        // Check if domain is complete using pre-parsed adaptive state
        $isDomainComplete = $this->adaptiveService->isDomainCompleteFromState($domain->id, $adaptiveState);

        if ($isDomainComplete) {
            return 20.0; // Full domain weight when complete
        }

        // Cap at 18% to prevent showing 100% when domain isn't complete
        // Use integer arithmetic to avoid floating point precision issues
        $progressPoints = min(18, $questionsAnswered * 2);
        $progressFromQuestions = (float) $progressPoints;

        \Log::debug('Domain Progress Detail', [
            'domain_id' => $domain->id,
            'domain_name' => $domain->name,
            'questions_answered' => $questionsAnswered,
            'is_complete' => $isDomainComplete,
            'progress' => $progressFromQuestions,
        ]);

        return $progressFromQuestions;
    }

    /**
     * Legacy method for backward compatibility - now optimized
     * @deprecated Use calculateDomainProgress with pre-loaded data instead
     */
    private function getDomainProgress(int $diagnosticId, int $domainId): float
    {
        // For backward compatibility, fall back to individual queries
        $questionsAnswered = DiagnosticResponse::where('diagnostic_id', $diagnosticId)
            ->whereHas('diagnosticItem.subtopic.topic.domain', function($query) use ($domainId) {
                $query->where('id', $domainId);
            })
            ->whereNotNull('user_answer')
            ->count();

        $isDomainComplete = $this->adaptiveService->isDomainComplete($diagnosticId, $domainId);

        if ($isDomainComplete) {
            return 20.0;
        }

        return (float) min(18, $questionsAnswered * 2);
    }

    /**
     * Calculate progress based on phase completion (legacy - keeping for backward compatibility)
     */
    private function calculatePhaseProgress(int $currentPhaseOrder, int $domainsCompleted): float
    {
        $totalPhases = \App\Models\DiagnosticPhase::active()->count();
        $phaseWeight = 100 / $totalPhases; // Each phase gets equal weight

        $completedPhases = max(0, $currentPhaseOrder - 1);
        $currentPhase = \App\Models\DiagnosticPhase::where('order_sequence', $currentPhaseOrder)->first();
        $domainsPerPhase = $currentPhase ? $currentPhase->target_domains : 5;

        $currentPhaseProgress = ($domainsCompleted / $domainsPerPhase) * $phaseWeight;

        return ($completedPhases * $phaseWeight) + $currentPhaseProgress;
    }

    /**
     * Check if user has completed current phase
     */
    private function checkPhaseCompletion($diagnostic): bool
    {
        $currentPhase = $diagnostic->phase;
        if (! $currentPhase) {
            return false;
        }

        // Get domains tested from responses
        $testedDomainIds = $diagnostic->responses()
            ->with('diagnosticItem.subtopic.topic.domain')
            ->get()
            ->pluck('diagnosticItem.subtopic.topic.domain.id')
            ->unique()
            ->values()
            ->toArray();

        // Get domains that belong to current phase
        $phaseDomainIds = $currentPhase->domains->pluck('id')->toArray();

        // Count domains completed in current phase
        $phaseDomainsCompleted = array_intersect($testedDomainIds, $phaseDomainIds);

        return count($phaseDomainsCompleted) >= $currentPhase->target_domains;
    }

    /**
     * Mark phase as completed and update progress
     */
    private function completePhase($diagnostic, int $phaseId): void
    {
        // Find next phase
        $currentPhase = \App\Models\DiagnosticPhase::find($phaseId);
        $nextPhase = $currentPhase ? $currentPhase->nextPhase() : null;

        if ($nextPhase) {
            $diagnostic->update([
                'phase_id' => $nextPhase->id,
            ]);
        }
    }

    // TODO: Reimplement these phase methods using response data instead of domains_completed
    /*
    public function phaseComplete(Diagnostic $diagnostic, int $phase): Response
    {
        // Implementation removed - needs to use response data
    }
    */

    /*
    public function continuePhase(Diagnostic $diagnostic, int $phase): RedirectResponse
    {
        // Implementation removed - needs update
    }
    */

    /*
    public function phaseResults(Diagnostic $diagnostic, int $phase): Response
    {
        // Implementation removed - needs to use response data
    }
    */

    /**
     * Get phase description
     */
    private function getPhaseDescription(int $phaseOrder): string
    {
        $phase = \App\Models\DiagnosticPhase::where('order_sequence', $phaseOrder)->first();

        return $phase ? $phase->description : 'Security assessment phase';
    }

    /**
     * Get domain name by ID
     */
    private function getDomainName(int $domainId): string
    {
        $domainNames = [
            1 => 'General Security Concepts',
            2 => 'Information Security Governance',
            3 => 'Legal, Regulatory & Compliance',
            4 => 'Privacy',
            5 => 'Risk Management',
            6 => 'Security Audits & Assessments',
            7 => 'Threat & Vulnerability Management',
            8 => 'Cryptography & Key Management',
            9 => 'Data Governance',
            10 => 'Access Control',
            11 => 'Network & Communication Security',
            12 => 'Application Security & DevSecOps',
            13 => 'Cloud Security',
            14 => 'Endpoint, Mobile & IoT Security',
            15 => 'Security Architecture & Design',
            16 => 'Security Awareness & Human Factors',
            17 => 'Physical & Environmental Security',
            18 => 'Security Operations & Monitoring',
            19 => 'Incident Management & Forensics',
            20 => 'Business Continuity & Disaster Recovery',
        ];

        return $domainNames[$domainId] ?? 'Unknown Domain';
    }

    /**
     * Submit individual answer during assessment.
     */
    public function answer(Request $request, Diagnostic $diagnostic)
    {
        return $this->submitAnswer($request, $diagnostic);
    }

    /**
     * Submit individual answer during assessment.
     */
    public function submitAnswer(Request $request, Diagnostic $diagnostic)
    {
        $validated = $request->validate([
            'selected_options' => 'required|array',
            'response_time' => 'required|integer|min:0',
            'diagnostic_item_id' => 'required|integer',
        ]);

        // Step 5: Get the current question from diagnostic_responses
        $currentResponse = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
            ->where('diagnostic_item_id', $validated['diagnostic_item_id'])
            ->whereNull('user_answer') // Find the unanswered question
            ->first();

        if (! $currentResponse) {
            return redirect()->route('assessments.diagnostics.show', $diagnostic)
                ->with('error', 'Question not found or already answered.');
        }

        $diagnosticItem = DiagnosticItem::find($validated['diagnostic_item_id']);
        if (! $diagnosticItem) {
            return redirect()->route('assessments.diagnostics.show', $diagnostic)
                ->with('error', 'Invalid question.');
        }

        // Step 6: Determine correct/incorrect
        $userAnswer = $validated['selected_options'];

        // Flatten nested arrays from frontend (e.g., [["Executive support"]] -> ["Executive support"])
        if (is_array($userAnswer) && count($userAnswer) === 1 && is_array($userAnswer[0])) {
            $userAnswer = $userAnswer[0];
        }

        $correctAnswers = $diagnosticItem->correct_options;

        // Ensure both are arrays for comparison
        if (! is_array($userAnswer)) {
            $userAnswer = [$userAnswer];
        }
        if (! is_array($correctAnswers)) {
            $correctAnswers = [$correctAnswers];
        }

        // Check if answer is correct (simple comparison for now)
        $isCorrect = ! empty(array_intersect($userAnswer, $correctAnswers)) &&
                    count($userAnswer) === count($correctAnswers);

        // Step 7: Update the diagnostic_responses table
        $currentResponse->update([
            'user_answer' => $userAnswer,
            'is_correct' => $isCorrect,
            'response_time_seconds' => $validated['response_time'],
        ]);

        // Update diagnostic duration
        $diagnostic->increment('total_duration_seconds', $validated['response_time']);

        // Refresh diagnostic to ensure we have latest data
        $diagnostic->refresh();

        // Step 8: Update adaptive state using AdaptiveService
        $adaptiveState = json_decode($diagnostic->adaptive_state, true);

        // Ensure adaptive state is valid
        if (! $adaptiveState || ! is_array($adaptiveState)) {
            \Log::error('Invalid adaptive state, reinitializing', [
                'diagnostic_id' => $diagnostic->id,
                'raw_state' => $diagnostic->adaptive_state,
            ]);
            $adaptiveState = $this->adaptiveService->initializeTest();
        }

        // Log state before processing
        \Log::info('Adaptive state before processing answer', [
            'diagnostic_id' => $diagnostic->id,
            'domain_id' => $diagnosticItem->subtopic->topic->domain_id,
            'is_correct' => $isCorrect,
            'state_before' => $adaptiveState,
        ]);

        // Use the adaptive service to process the answer
        $adaptiveState = $this->adaptiveService->processAnswer($adaptiveState, $diagnosticItem, $isCorrect);

        // Log state after processing
        \Log::info('Adaptive state after processing answer', [
            'diagnostic_id' => $diagnostic->id,
            'domain_id' => $diagnosticItem->subtopic->topic->domain_id,
            'state_after' => $adaptiveState,
        ]);

        // CRITICAL: Save the updated adaptive state back to the database
        $diagnostic->update([
            'adaptive_state' => json_encode($adaptiveState),
        ]);

        // Check if test is complete using adaptive service
        $totalAnswered = $diagnostic->responses()->whereNotNull('user_answer')->count();

        // Debug: Log the exact count query
        \Log::info('Counting answered questions', [
            'diagnostic_id' => $diagnostic->id,
            'total_responses' => $diagnostic->responses()->count(),
            'answered_responses' => $totalAnswered,
            'current_response_id' => $currentResponse->id,
            'adaptive_state_before_check' => $adaptiveState,
        ]);

        $isComplete = $this->adaptiveService->isTestComplete($adaptiveState, $totalAnswered);

        \Log::info('Diagnostic progress', [
            'diagnostic_id' => $diagnostic->id,
            'total_answered' => $totalAnswered,
            'is_complete' => $isComplete,
            'domain_levels' => $adaptiveState['domain_bloom_levels'] ?? [],
            'domain_streaks' => $adaptiveState['domain_streaks'] ?? [],
        ]);

        if ($isComplete) {
            // Complete the diagnostic
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
                'adaptive_state' => json_encode($adaptiveState),
            ]);

            // Calculate final score
            $totalAnswered = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
                ->whereNotNull('user_answer')
                ->count();
            $correctAnswers = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
                ->where('is_correct', true)
                ->count();

            $score = $totalAnswered > 0 ? round(($correctAnswers / $totalAnswered) * 100, 2) : 0;

            // Calculate total duration from all responses
            $totalDuration = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
                ->whereNotNull('response_time_seconds')
                ->sum('response_time_seconds');

            $diagnostic->update([
                'score' => $score,
                'total_duration_seconds' => $totalDuration,
            ]);

            return redirect()->route('assessments.diagnostics.all-results');
        }

        // Step 9: Generate next question and store in responses table
        // Note: adaptive state was already saved above, no need to save again
        $this->generateNextQuestion($diagnostic);

        // Redirect to show the next question
        return redirect()->route('assessments.diagnostics.show', $diagnostic);
    }

    /**
     * Submit diagnostic responses.
     */
    public function submit(Request $request, Diagnostic $diagnostic): Response
    {
        $validated = $request->validate([
            'responses' => 'required|array',
            'time_taken' => 'required|integer|min:0',
        ]);

        $score = 0;
        $totalQuestions = count($validated['responses']);

        // Calculate score (simplified for demo)
        foreach ($validated['responses'] as $response) {
            // Simplified scoring logic
            if (isset($response['is_correct']) && $response['is_correct']) {
                $score++;
            }
        }

        // Update assessment
        $diagnostic->update([
            'status' => 'completed',
            'completed_at' => now(),
            'score' => round(($score / $totalQuestions) * 100, 2),
            'time_taken' => $validated['time_taken'],
        ]);

        // Update user abilities if authenticated
        if (auth()->check()) {
            $this->abilityService->updateFromDiagnostic(auth()->user(), $diagnostic);
        }

        // For authenticated users, redirect to results
        return redirect()->route('assessments.diagnostics.all-results', ['diagnostic_id' => $diagnostic->id]);
    }


    /**
     * Display all diagnostic results for all 4 phases.
     */
    public function allResults(Request $request): Response|RedirectResponse
    {
        // Only authenticated users can view results
        if (! auth()->check()) {
            return redirect()->route('auth.login')
                ->with('message', 'Please log in to view your diagnostic results.');
        }

        // Get all phases
        $phases = \App\Models\DiagnosticPhase::active()->orderBy('order_sequence')->get();

        // Initialize phase results structure
        $phaseResults = [];
        $allPhasesCompleted = true;
        $previousPhaseCompleted = true; // Phase 1 can always start

        foreach ($phases as $phase) {
            // Get all diagnostics for this phase
            $phaseDiagnostics = Diagnostic::where('user_id', auth()->id())
                ->where('phase_id', $phase->id)
                ->whereIn('status', ['completed', 'paused', 'in_progress'])
                ->with(['responses.diagnosticItem.subtopic.topic.domain'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Filter to only include diagnostics with answered questions
            $validDiagnostics = $phaseDiagnostics->filter(function ($diagnostic) {
                return $diagnostic->responses()->whereNotNull('user_answer')->count() > 0;
            });

            $phaseData = [
                'id' => $phase->id,
                'order' => $phase->order_sequence,
                'name' => $phase->name,
                'description' => $phase->description,
                'completed' => false,
                'locked' => ! $previousPhaseCompleted,
                'attempts' => [],
                'selected_attempt' => null,
                'domain_performance' => [],
                'score' => 0,
            ];

            if ($validDiagnostics->isNotEmpty()) {
                // Phase has attempts
                $phaseData['attempts'] = $validDiagnostics->map(function ($diagnostic) {
                    $responses = $diagnostic->responses()->whereNotNull('user_answer')->get();
                    $correctCount = $responses->where('is_correct', true)->count();
                    $totalAnswered = $responses->count();
                    $score = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100, 1) : 0;

                    return [
                        'id' => $diagnostic->id,
                        'date' => $diagnostic->created_at->format('M d, Y'),
                        'score' => $score,
                        'status' => $diagnostic->status,
                        'questions_answered' => $totalAnswered,
                        'duration' => $diagnostic->total_duration_seconds,
                        'is_latest' => false,
                    ];
                })->values()->toArray();

                // Mark the first (latest) as selected
                if (! empty($phaseData['attempts'])) {
                    $phaseData['attempts'][0]['is_latest'] = true;
                }

                // Get detailed data for the latest attempt
                $latestDiagnostic = $validDiagnostics->first();
                $responses = $latestDiagnostic->responses()->whereNotNull('user_answer')
                    ->with(['diagnosticItem.subtopic.topic.domain'])
                    ->get();

                $correctCount = $responses->where('is_correct', true)->count();
                $totalAnswered = $responses->count();
                $score = $totalAnswered > 0 ? round(($correctCount / $totalAnswered) * 100, 1) : 0;

                // Domain performance for this phase
                $domainPerformance = $responses->groupBy(function ($response) {
                    return $response->diagnosticItem?->topic?->domain?->name ?? 'Unknown';
                })
                    ->map(function ($domainResponses, $domainName) {
                        $correct = $domainResponses->where('is_correct', true)->count();
                        $total = $domainResponses->count();

                        return [
                            'name' => $domainName,
                            'score' => $total > 0 ? round(($correct / $total) * 100, 1) : 0,
                            'correct' => $correct,
                            'total' => $total,
                        ];
                    })->values()->toArray();

                $phaseData['selected_attempt'] = [
                    'id' => $latestDiagnostic->id,
                    'score' => $score,
                    'correct_count' => $correctCount,
                    'total_questions' => $totalAnswered,
                    'duration' => $latestDiagnostic->total_duration_seconds,
                    'status' => $latestDiagnostic->status,
                ];

                $phaseData['domain_performance'] = $domainPerformance;
                $phaseData['score'] = $score;
                $phaseData['completed'] = $latestDiagnostic->status === 'completed';

                // Update completion status for next phase
                if ($phaseData['completed']) {
                    $previousPhaseCompleted = true;
                } else {
                    $previousPhaseCompleted = false;
                    $allPhasesCompleted = false;
                }
            } else {
                // No attempts for this phase
                $previousPhaseCompleted = false;
                $allPhasesCompleted = false;
            }

            $phaseResults[$phase->order_sequence] = $phaseData;
        }

        // Generate subtopic analysis if all phases completed
        $subtopicAnalysis = null;
        if ($allPhasesCompleted) {
            $subtopicAnalysis = $this->generateSubtopicAnalysis($phaseResults);
        }

        // Debug: Log the phase results structure
        \Log::info('Phase Results Structure', [
            'phase_count' => count($phaseResults),
            'phase_keys' => array_keys($phaseResults),
            'phases_summary' => collect($phaseResults)->map(function ($phase) {
                return [
                    'id' => $phase['id'],
                    'name' => $phase['name'],
                    'completed' => $phase['completed'],
                    'locked' => $phase['locked'],
                    'attempts_count' => count($phase['attempts']),
                ];
            })->toArray(),
        ]);

        return Inertia::render('Diagnostics/AllResults', [
            'phases' => $phaseResults,
            'all_phases_completed' => $allPhasesCompleted,
            'subtopic_analysis' => $subtopicAnalysis,
        ]);
    }

    /**
     * Display a specific diagnostic.
     */
    public function show(Diagnostic $diagnostic): Response|RedirectResponse
    {
        // Check ownership for authenticated users
        if ($diagnostic->user_id !== auth()->id()) {
            abort(403, 'You can only view your own assessments.');
        }

        // Check if diagnostic is completed
        if ($diagnostic->status === 'completed') {
            return redirect()->route('assessments.diagnostics.all-results');
        }

        // Get current unanswered question from diagnostic_responses
        $currentResponse = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
            ->whereNull('user_answer')
            ->with('diagnosticItem.subtopic.topic.domain')
            ->orderBy('created_at')
            ->first();

        if (! $currentResponse) {
            // No more questions available, complete the diagnostic
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            return redirect()->route('assessments.diagnostics.all-results');
        }

        $diagnosticItem = $currentResponse->diagnosticItem;

        // Format question for frontend (compatible with QuizTypes)
        $currentQuestion = [
            'id' => $diagnosticItem->id,
            'content' => $diagnosticItem->content,
            'type_id' => $diagnosticItem->type_id,
            'options' => $diagnosticItem->options,
            'correct_answer' => $diagnosticItem->correct_options[0] ?? '',
            'correct_options' => $diagnosticItem->correct_options,
            'settings' => $diagnosticItem->settings ?? [],
            'difficulty' => ['name' => $this->getDifficultyName($diagnosticItem->difficulty_level)],
            'bloom' => ['level' => $this->getBloomName($diagnosticItem->bloom_level)],
            'topic' => [
                'name' => $diagnosticItem->subtopic->topic->name ?? 'General Topic',
                'domain' => ['name' => $diagnosticItem->subtopic->topic->domain->name ?? 'General Domain'],
            ],
        ];

        // Progressive assessment data using new phase system
        $totalPhases = \App\Models\DiagnosticPhase::active()->count();
        $totalDomains = \App\Models\DiagnosticDomain::active()->count();
        $currentPhase = $diagnostic->phase;

        $progressiveData = [
            'total_domains' => $totalDomains,
            'phases_total' => $totalPhases,
            'domains_per_phase' => $currentPhase ? $currentPhase->target_domains : 5,
            'current_phase' => $currentPhase ? $currentPhase->order_sequence : 1,
            'current_phase_name' => $currentPhase ? $currentPhase->name : 'Foundation & Governance',
            'current_domain' => $currentQuestion['topic']['domain']['name'],
            'adaptive_mode' => true,
            'typical_question_range' => '20-100 total',
            'questions_per_domain' => '4-12',
        ];

        // Calculate progress based on answered questions and current phase
        $totalAnswered = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
            ->whereNotNull('user_answer')
            ->count();

        $adaptiveState = json_decode($diagnostic->adaptive_state, true) ?? [];
        $currentPhase = $adaptiveState['current_phase'] ?? 1;
        $totalPhases = 4; // 4-phase system

        // Calculate progress using domain-based logic
        if ($diagnostic->status === 'completed') {
            $progress = 100;
        } else {
            $progress = $this->calculateProgress($diagnostic);
        }

        return Inertia::render('Diagnostics/Test/Quiz', [
            'diagnostic' => array_merge($diagnostic->toArray(), $progressiveData),
            'question' => $currentQuestion,
            'progress' => $progress,
            'totalQuestions' => null, // Adaptive - unknown total
            'currentQuestionNumber' => $totalAnswered + 1,
        ]);
    }

    /**
     * Review diagnostic questions and answers.
     */
    public function review(Diagnostic $diagnostic): Response
    {
        // Check ownership for authenticated users
        if ($diagnostic->user_id !== auth()->id()) {
            abort(403, 'You can only review your own assessments.');
        }

        // Check if diagnostic is completed
        if ($diagnostic->status !== 'completed') {
            return redirect()->route('assessments.diagnostics.show', $diagnostic)
                ->with('error', 'You can only review completed assessments.');
        }

        // Load diagnostic with all responses and questions
        $diagnostic->load([
            'responses' => function ($query) {
                $query->whereNotNull('user_answer')
                      ->orderBy('created_at')
                      ->with([
                          'diagnosticItem.subtopic.topic.domain',
                          'diagnosticItem' => function ($itemQuery) {
                              $itemQuery->select([
                                  'id', 'subtopic_id', 'content', 'options', 'correct_options', 
                                  'justifications', 'type_id', 'difficulty_level', 'bloom_level'
                              ]);
                          }
                      ]);
            }
        ]);

        // Transform the data structure for the Review component
        $transformedResponses = $diagnostic->responses->map(function ($response) {
            return [
                'id' => $response->id,
                'user_answer' => $response->user_answer,
                'is_correct' => $response->is_correct,
                'response_time_seconds' => $response->response_time_seconds,
                'item' => [
                    'id' => $response->diagnosticItem->id,
                    'content' => $response->diagnosticItem->content,
                    'question' => $response->diagnosticItem->content, // For Type1Review compatibility
                    'options' => $response->diagnosticItem->options,
                    'correct_options' => $response->diagnosticItem->correct_options,
                    'justifications' => $response->diagnosticItem->justifications,
                    'type_id' => $response->diagnosticItem->type_id ?? 1,
                    'difficulty' => $response->diagnosticItem->difficulty_level,
                    'bloom' => $response->diagnosticItem->bloom_level,
                    'topic' => [
                        'id' => $response->diagnosticItem->subtopic->topic->id,
                        'name' => $response->diagnosticItem->subtopic->topic->name,
                        'domain' => [
                            'id' => $response->diagnosticItem->subtopic->topic->domain->id,
                            'name' => $response->diagnosticItem->subtopic->topic->domain->name,
                        ]
                    ]
                ]
            ];
        });

        $diagnosticData = [
            'id' => $diagnostic->id,
            'status' => $diagnostic->status,
            'score' => $diagnostic->score,
            'responses' => $transformedResponses,
        ];

        return Inertia::render('Diagnostics/Test/Review', [
            'diagnostic' => $diagnosticData,
        ]);
    }

    /**
     * Generate detailed PDF report for diagnostic.
     */
    public function report(Diagnostic $diagnostic): Response
    {
        // Only authenticated users can view reports
        if (! auth()->check()) {
            return redirect()->route('auth.login')
                ->with('message', 'Please log in to view your report.');
        }

        // Check if user owns this assessment
        if ($diagnostic->user_id !== auth()->id()) {
            abort(403, 'You can only view your own reports.');
        }

        $responses = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
            ->with(['diagnosticItem.subtopic.topic.domain'])
            ->get();

        $domainPerformance = $responses->groupBy(function ($response) {
            return $response->diagnosticItem?->topic?->domain?->name ?? 'Unknown Domain';
        })
            ->map(function ($domainResponses) {
                $correct = $domainResponses->where('is_correct', true)->count();
                $total = $domainResponses->count();

                return [
                    'correct' => $correct,
                    'total' => $total,
                    'percentage' => $total > 0 ? round(($correct / $total) * 100, 2) : 0,
                ];
            });

        return Inertia::render('Diagnostics/Report', [
            'diagnostic' => $diagnostic,
            'responses' => $responses,
            'domainPerformance' => $domainPerformance,
            'recommendations' => $this->generateRecommendations($domainPerformance),
        ]);
    }

    /**
     * Check if the answer is correct.
     */
    private function checkAnswer($question, $answer): bool
    {
        // Implementation depends on question type
        // This is a simplified version
        return $question->correct_answer === $answer;
    }

    /**
     * Generate study recommendations based on performance.
     */
    private function generateRecommendations($domainPerformance): array
    {
        $recommendations = [];

        foreach ($domainPerformance as $domain => $performance) {
            // Handle different data structures
            if (is_array($performance)) {
                // For results method: array with 'name' and 'score' keys
                if (isset($performance['name'])) {
                    $domainName = $performance['name'];
                    $score = $performance['score'] ?? 0;
                }
                // For report method: array with 'percentage' key, domain as array key
                else {
                    $domainName = $domain;
                    $score = $performance['percentage'] ?? 0;
                }
            } else {
                // Fallback
                $domainName = $domain;
                $score = 0;
            }

            if ($score < 70) {
                $recommendations[] = "Focus on improving your knowledge in {$domainName}";
            } elseif ($score < 85) {
                $recommendations[] = "Good understanding of {$domainName}, but there's room for improvement";
            }
        }

        // Limit recommendations and ensure they are plain strings
        return array_slice($recommendations, 0, 4);
    }

    /**
     * Generate subtopic-based performance analysis based on all phase results.
     */
    private function generateSubtopicAnalysis($phaseResults): array
    {
        $subtopicPerformance = [];
        $overallStats = [
            'total_subtopics' => 0,
            'mastered_subtopics' => 0,
            'developing_subtopics' => 0,
            'needs_improvement_subtopics' => 0,
        ];

        // Collect all diagnostic responses across all phases
        $allResponses = collect();
        foreach ($phaseResults as $phase) {
            if ($phase['completed']) {
                foreach ($phase['attempts'] as $attempt) {
                    $diagnostic = Diagnostic::with([
                        'responses.diagnosticItem.subtopic.topic.domain'
                    ])->find($attempt['id']);
                    
                    if ($diagnostic) {
                        $allResponses = $allResponses->merge($diagnostic->responses);
                    }
                }
            }
        }

        // Group responses by subtopic
        $subtopicGroups = $allResponses->groupBy(function ($response) {
            return $response->diagnosticItem->subtopic->id ?? 'unknown';
        });

        foreach ($subtopicGroups as $subtopicId => $responses) {
            if ($subtopicId === 'unknown') continue;

            $firstResponse = $responses->first();
            $subtopic = $firstResponse->diagnosticItem->subtopic;
            
            $totalQuestions = $responses->count();
            $correctAnswers = $responses->where('is_correct', true)->count();
            $accuracy = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
            
            // Calculate bloom level distribution
            $bloomLevels = $responses->map(function ($response) {
                return $response->diagnosticItem->bloom_level ?? 3;
            });
            
            $avgBloomLevel = $bloomLevels->avg();
            $maxBloomLevel = $bloomLevels->max();
            
            // Determine proficiency level
            $proficiencyLevel = 'Needs Improvement';
            if ($accuracy >= 80) {
                $proficiencyLevel = 'Mastered';
                $overallStats['mastered_subtopics']++;
            } elseif ($accuracy >= 60) {
                $proficiencyLevel = 'Developing';
                $overallStats['developing_subtopics']++;
            } else {
                $overallStats['needs_improvement_subtopics']++;
            }

            $subtopicPerformance[] = [
                'id' => $subtopic->id,
                'name' => $subtopic->name,
                'topic_name' => $subtopic->topic->name,
                'domain_name' => $subtopic->topic->domain->name,
                'description' => $subtopic->description,
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'accuracy' => round($accuracy, 1),
                'avg_bloom_level' => round($avgBloomLevel, 1),
                'max_bloom_level' => $maxBloomLevel,
                'proficiency_level' => $proficiencyLevel,
            ];
            
            $overallStats['total_subtopics']++;
        }

        // Sort by accuracy descending
        usort($subtopicPerformance, function ($a, $b) {
            return $b['accuracy'] <=> $a['accuracy'];
        });

        // Get top strengths and areas for improvement
        $strengths = array_slice(array_filter($subtopicPerformance, function ($subtopic) {
            return $subtopic['proficiency_level'] === 'Mastered';
        }), 0, 5);

        $improvements = array_slice(array_filter($subtopicPerformance, function ($subtopic) {
            return $subtopic['proficiency_level'] === 'Needs Improvement';
        }), 0, 5);

        // Calculate overall mastery percentage
        $masteryPercentage = $overallStats['total_subtopics'] > 0 
            ? round(($overallStats['mastered_subtopics'] / $overallStats['total_subtopics']) * 100, 1) 
            : 0;

        return [
            'subtopic_performance' => $subtopicPerformance,
            'overall_stats' => $overallStats,
            'mastery_percentage' => $masteryPercentage,
            'top_strengths' => $strengths,
            'improvement_areas' => $improvements,
        ];
    }


    /**
     * Generate a diagnostic question based on current domain and phase
     * Enhanced: Load actual questions from diagnostic_items table
     */
    private function generateQuestionForDiagnostic(Diagnostic $diagnostic): array
    {
        // Get current domain info with safe defaults
        $currentPhaseOrder = $diagnostic->phase?->order_sequence ?? 1;
        $answeredCount = $diagnostic->responses()->whereNotNull('user_answer')->count();
        $questionNumber = $answeredCount + 1;

        // Calculate domain index for question selection
        $domainIndex = (($currentPhaseOrder - 1) * 5) + (($questionNumber - 1) % 5) + 1;
        $domainIndex = min($domainIndex, 20); // Max 20 domains

        // Get domain name for the current phase
        $domainName = $this->getDomainName($domainIndex);

        // Load diagnostic items for the current domain
        $diagnosticItems = \App\Models\DiagnosticItem::whereHas('subtopic.topic.domain', function ($query) use ($domainName) {
            $query->where('name', $domainName);
        })->where('status', 'published')->get();

        // If no items found for this domain, get any available items
        if ($diagnosticItems->isEmpty()) {
            $diagnosticItems = \App\Models\DiagnosticItem::where('status', 'published')->get();
        }

        // If still no items, return a fallback question
        if ($diagnosticItems->isEmpty()) {
            return $this->getFallbackQuestion($questionNumber, $domainName);
        }

        // Select question based on current question number (cyclical)
        $questionIndex = ($questionNumber - 1) % $diagnosticItems->count();
        $selectedItem = $diagnosticItems[$questionIndex];

        // Get the first correct option as the correct answer
        $correctAnswer = $selectedItem->correct_options[0] ?? '';

        return [
            'id' => $questionNumber,
            'content' => $selectedItem->content,
            'type_id' => $selectedItem->type_id,
            'options' => $selectedItem->options,
            'correct_answer' => $correctAnswer,
            'difficulty' => ['name' => $this->getDifficultyName($selectedItem->difficulty_level)],
            'bloom' => ['level' => $this->getBloomName($selectedItem->bloom_level)],
            'topic' => [
                'name' => $selectedItem->topic->name ?? 'General Topic',
                'domain' => ['name' => $domainName],
            ],
        ];
    }

    /**
     * Get fallback question when no diagnostic items are available
     */
    private function getFallbackQuestion(int $questionNumber, string $domainName): array
    {
        return [
            'id' => $questionNumber,
            'content' => 'Which of the following best describes the CIA triad in information security?',
            'type_id' => 1,
            'options' => [
                'Central Intelligence Agency security protocols',
                'Confidentiality, Integrity, and Availability',
                'Chief Information Assurance requirements',
                'Corporate Identity Authentication methods',
            ],
            'correct_answer' => 'Confidentiality, Integrity, and Availability',
            'difficulty' => ['name' => 'Medium'],
            'bloom' => ['level' => 'Understand'],
            'topic' => [
                'name' => 'CIA Triad',
                'domain' => ['name' => $domainName],
            ],
        ];
    }

    /**
     * Get difficulty name from level
     */
    private function getDifficultyName(int $level): string
    {
        $difficulties = [
            1 => 'Easy',
            2 => 'Medium',
            3 => 'Hard',
        ];

        return $difficulties[$level] ?? 'Medium';
    }

    /**
     * Get bloom level name from level
     */
    private function getBloomName(int $level): string
    {
        $blooms = [
            1 => 'Remember',
            2 => 'Understand',
            3 => 'Apply',
            4 => 'Analyze',
            5 => 'Evaluate',
            6 => 'Create',
        ];

        return $blooms[$level] ?? 'Understand';
    }

    /**
     * Generate next question using AdaptiveService and store in diagnostic_responses table
     */
    private function generateAndStoreNextQuestion(Diagnostic $diagnostic): void
    {
        // Get current adaptive state
        $adaptiveState = json_decode($diagnostic->adaptive_state, true);

        // For now, generateNextQuestion handles question selection
        // TODO: Integrate with minimal adaptive service when ready
        $nextQuestion = null;

        if (! $nextQuestion) {
            // No more questions available - complete the diagnostic
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            return;
        }

        // Store the question in diagnostic_responses table
        DiagnosticResponse::create([
            'diagnostic_id' => $diagnostic->id,
            'diagnostic_item_id' => $nextQuestion->id,
            'user_answer' => null, // Will be filled when user answers
            'is_correct' => null, // Will be determined when user answers
            'response_time_seconds' => null, // Will be filled when user answers
        ]);
    }

    /**
     * Generate first question without using AdaptiveService
     */
    private function generateFirstQuestion(Diagnostic $diagnostic): void
    {
        // Get the current phase ID
        $currentPhaseId = $diagnostic->phase_id;

        if (! $currentPhaseId) {
            \Log::error('No current phase ID found for diagnostic '.$diagnostic->id);

            return;
        }

        // Get a question from domains in the current phase only
        $firstQuestion = DiagnosticItem::where('status', 'published')
            ->where('bloom_level', 3) // Start at Apply level (3)
            ->whereHas('subtopic.topic.domain', function ($query) use ($currentPhaseId) {
                $query->where('phase_id', $currentPhaseId)
                    ->where('is_active', true);
            })
            ->inRandomOrder()
            ->first();

        // If no level 3 questions, try level 2
        if (! $firstQuestion) {
            $firstQuestion = DiagnosticItem::where('status', 'published')
                ->where('bloom_level', 2)
                ->whereHas('subtopic.topic.domain', function ($query) use ($currentPhaseId) {
                    $query->where('phase_id', $currentPhaseId)
                        ->where('is_active', true);
                })
                ->inRandomOrder()
                ->first();
        }

        if (! $firstQuestion) {
            // No questions available for this phase
            \Log::error('No diagnostic questions found for phase '.$currentPhaseId.' in diagnostic '.$diagnostic->id);

            return;
        }

        // Update adaptive state with last tested domain for round-robin tracking
        $firstQuestionWithRelations = $firstQuestion->load('subtopic.topic.domain');
        $domainId = $firstQuestionWithRelations->subtopic->topic->domain_id;
        
        $adaptiveState = json_decode($diagnostic->adaptive_state, true) ?: [];
        $adaptiveState['last_tested_domain'] = $domainId;
        $diagnostic->update([
            'adaptive_state' => json_encode($adaptiveState),
        ]);

        // Store the question in diagnostic_responses table
        DiagnosticResponse::create([
            'diagnostic_id' => $diagnostic->id,
            'diagnostic_item_id' => $firstQuestion->id,
            'user_answer' => null, // Will be filled when user answers
            'is_correct' => null, // Will be determined when user answers
            'response_time_seconds' => null, // Will be filled when user answers
        ]);
    }

    /**
     * Generate next question using AdaptiveDiagnosticService
     */
    private function generateNextQuestion(Diagnostic $diagnostic): void
    {
        // Refresh diagnostic to ensure we have the latest state
        $diagnostic->refresh();

        // Get current phase ID
        $currentPhaseId = $diagnostic->phase_id;

        if (! $currentPhaseId) {
            \Log::error('No current phase ID found for diagnostic '.$diagnostic->id);
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            return;
        }

        // Get existing question IDs
        $existingQuestionIds = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
            ->pluck('diagnostic_item_id')
            ->toArray();

        // Get adaptive state
        $adaptiveState = json_decode($diagnostic->adaptive_state, true) ?: [];

        // Use service to select next question
        $questionSelection = $this->adaptiveService->selectNextQuestion(
            $adaptiveState,
            $existingQuestionIds,
            $currentPhaseId
        );

        if ($questionSelection === null) {
            // No more questions needed in this phase
            \Log::info('No more questions needed in phase '.$currentPhaseId.' for diagnostic '.$diagnostic->id);

            // Check if test is complete
            $totalQuestions = DiagnosticResponse::where('diagnostic_id', $diagnostic->id)
                ->whereNotNull('user_answer')
                ->count();

            if ($this->adaptiveService->isTestComplete($adaptiveState, $totalQuestions)) {
                $diagnostic->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                ]);

                return;
            }

            // For now, complete the diagnostic when phase is done
            // Users must manually start the next phase if desired
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            \Log::info('Phase '.$currentPhaseId.' completed for diagnostic '.$diagnostic->id);

            return;
        }

        // Get the actual question
        $nextQuestion = DiagnosticItem::find($questionSelection['question_id']);

        if (! $nextQuestion) {
            \Log::error('Selected question not found', ['question_id' => $questionSelection['question_id']]);
            $diagnostic->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            return;
        }

        \Log::info('Selected next question', [
            'diagnostic_id' => $diagnostic->id,
            'question_id' => $nextQuestion->id,
            'domain_id' => $questionSelection['domain_id'],
            'target_bloom' => $questionSelection['target_bloom_level'],
            'actual_bloom' => $questionSelection['bloom_level'],
        ]);

        // Update adaptive state with last tested domain for round-robin tracking
        if (isset($questionSelection['last_tested_domain'])) {
            $adaptiveState['last_tested_domain'] = $questionSelection['last_tested_domain'];
            $diagnostic->update([
                'adaptive_state' => json_encode($adaptiveState),
            ]);
        }

        // Store the question in diagnostic_responses table
        DiagnosticResponse::create([
            'diagnostic_id' => $diagnostic->id,
            'diagnostic_item_id' => $nextQuestion->id,
            'user_answer' => null,
            'is_correct' => null,
            'response_time_seconds' => null,
        ]);
    }
}
