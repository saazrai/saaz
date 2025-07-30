<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SampleQuizAssessment;
use App\Models\SampleQuizResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class SampleQuizController extends Controller
{
    /**
     * Create a new sample quiz assessment (RESTful approach)
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'total_questions' => 'integer|min:1|max:50',
                'type' => 'string|in:sample',
            ]);

            // Check for existing in-progress assessment by user fingerprint
            $existingAssessment = SampleQuizAssessment::where('status', 'in_progress')
                ->where('user_agent', $request->userAgent())
                ->where('ip_address', $request->ip())
                ->where('created_at', '>', now()->subHours(24)) // Within last 24 hours
                ->first();

            if ($existingAssessment) {
                // Return existing assessment instead of creating new one
                return response()->json([
                    'success' => true,
                    'assessment' => [
                        'id' => $existingAssessment->id,
                        'session_id' => $existingAssessment->session_id,
                        'status' => $existingAssessment->status,
                        'total_questions' => $existingAssessment->total_questions,
                        'started_at' => $existingAssessment->started_at->toISOString(),
                    ],
                    'message' => 'Resuming existing assessment',
                    'is_resumed' => true,
                ], 200);
            }

            $sessionId = 'sample_' . Str::random(32) . '_' . time();
            
            // Create new assessment record
            $assessment = SampleQuizAssessment::create([
                'session_id' => $sessionId,
                'total_questions' => $validated['total_questions'] ?? 10,
                'status' => 'in_progress',
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'started_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'assessment' => [
                    'id' => $assessment->id,
                    'session_id' => $assessment->session_id,
                    'status' => $assessment->status,
                    'total_questions' => $assessment->total_questions,
                    'started_at' => $assessment->started_at->toISOString(),
                ],
                'message' => 'New assessment created successfully',
                'is_resumed' => false,
            ], 201);
            
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid data provided',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Assessment creation error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create assessment',
            ], 500);
        }
    }

    /**
     * Generate a unique session ID and create assessment record
     * @deprecated Use store() method instead
     */
    public function generateSessionId(Request $request): JsonResponse
    {
        try {
            $sessionId = 'sample_' . Str::random(32) . '_' . time();
            
            // Create assessment record in "in_progress" status
            $assessment = SampleQuizAssessment::create([
                'session_id' => $sessionId,
                'total_questions' => 10, // Default sample quiz length
                'status' => 'in_progress',
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'started_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'session_id' => $sessionId,
                'assessment_id' => $assessment->id,
                'timestamp' => now()->toISOString(),
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Session ID generation error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate session ID',
            ], 500);
        }
    }

    /**
     * Store individual question response
     */
    public function storeResponse(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'session_id' => 'required|string|max:100',
                'question_id' => 'required|integer',
                'question_sequence' => 'required|integer|min:1',
                'selected_options' => 'required|array',
                'is_correct' => 'required|boolean',
                'response_time_seconds' => 'nullable|integer|min:0',
                // Question metadata for analytics
                'question_type' => 'nullable|string|max:50',
                'domain' => 'nullable|string|max:100',
                'topic' => 'nullable|string|max:100',
                'difficulty' => 'nullable|string|max:20',
                'bloom_level' => 'nullable|string|max:20',
                // Additional metadata (e.g., commands for type 7 simulation questions)
                'metadata' => 'nullable|array',
            ]);

            // Find the assessment
            $assessment = SampleQuizAssessment::where('session_id', $validated['session_id'])->first();
            
            if (!$assessment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assessment not found',
                ], 404);
            }

            // Check if response already exists (prevent duplicates)
            $existingResponse = SampleQuizResponse::where([
                ['sample_quiz_assessment_id', $assessment->id],
                ['diagnostic_item_id', $validated['question_id']]
            ])->first();

            if ($existingResponse) {
                return response()->json([
                    'success' => true,
                    'message' => 'Response already recorded',
                    'response_id' => $existingResponse->id,
                ]);
            }

            // Create response record
            $response = SampleQuizResponse::create([
                'sample_quiz_assessment_id' => $assessment->id,
                'diagnostic_item_id' => $validated['question_id'],
                'question_sequence' => $validated['question_sequence'],
                'user_answer' => $validated['selected_options'],
                'is_correct' => $validated['is_correct'],
                'response_time_seconds' => $validated['response_time_seconds'] ?? null,
                'metadata' => $validated['metadata'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Response recorded successfully',
                'response_id' => $response->id,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid data provided',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Response storage error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to record response',
            ], 500);
        }
    }

    /**
     * Get assessment progress for resumed sessions
     */
    public function getProgress(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'session_id' => 'required|string|max:100',
            ]);

            // Find the assessment
            $assessment = SampleQuizAssessment::where('session_id', $validated['session_id'])->first();
            
            if (!$assessment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assessment not found',
                ], 404);
            }

            // Get existing responses
            $responses = $assessment->responses()
                ->orderBy('question_sequence')
                ->get();

            $progress = $responses->map(function ($response) {
                // Load the question to recalculate is_correct
                $question = \App\Models\DiagnosticItem::find($response->diagnostic_item_id);
                $isCorrect = $response->is_correct;
                
                // Recalculate for Type 5 questions (matching)
                if ($question && $question->type_id == 5) {
                    $userAnswer = $response->user_answer;
                    $correctOptions = $question->correct_options;
                    
                    if (is_array($userAnswer) && is_array($correctOptions)) {
                        $isCorrect = count($userAnswer) === count($correctOptions) &&
                                   array_values($userAnswer) === array_values($correctOptions);
                    }
                }
                
                return [
                    'question_id' => $response->diagnostic_item_id,
                    'question_sequence' => $response->question_sequence,
                    'selected_options' => $response->user_answer,
                    'is_correct' => $isCorrect,
                    'response_time_seconds' => $response->response_time_seconds,
                    'metadata' => $response->metadata,
                ];
            });

            // Recalculate score based on corrected is_correct values
            $correctCount = $progress->filter(function ($item) {
                return $item['is_correct'] === true;
            })->count();
            
            $recalculatedScore = $assessment->total_questions > 0 
                ? round(($correctCount / $assessment->total_questions) * 100) 
                : 0;
            
            return response()->json([
                'success' => true,
                'assessment' => [
                    'id' => $assessment->id,
                    'session_id' => $assessment->session_id,
                    'status' => $assessment->status,
                    'total_questions' => $assessment->total_questions,
                    'score' => $recalculatedScore, // Use recalculated score
                    'started_at' => $assessment->started_at->toISOString(),
                    'completed_at' => $assessment->completed_at ? $assessment->completed_at->toISOString() : null,
                ],
                'progress' => $progress,
                'current_question' => $responses->count() + 1, // Next question to answer
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid data provided',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Progress retrieval error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve progress',
            ], 500);
        }
    }

    /**
     * Complete assessment and calculate final score
     */
    public function completeAssessment(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'session_id' => 'required|string|max:100',
                'completion_time_seconds' => 'required|integer|min:0',
            ]);

            // Find the assessment
            $assessment = SampleQuizAssessment::where('session_id', $validated['session_id'])->first();
            
            if (!$assessment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Assessment not found',
                ], 404);
            }

            if ($assessment->status === 'completed') {
                return response()->json([
                    'success' => true,
                    'message' => 'Assessment already completed',
                    'session_id' => $assessment->session_id,
                    'score' => $assessment->score,
                ]);
            }

            // Update completion details
            $assessment->completion_time_seconds = $validated['completion_time_seconds'];
            $assessment->markCompleted(); // This calculates score and sets completed status

            return response()->json([
                'success' => true,
                'message' => 'Assessment completed successfully',
                'session_id' => $assessment->session_id,
                'score' => $assessment->score,
                'responses_count' => $assessment->responses()->count(),
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid data provided',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Assessment completion error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to complete assessment',
            ], 500);
        }
    }

    /**
     * Get analytics summary (for admin use)
     */
    public function getAnalytics(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $stats = SampleQuizAssessment::getCompletionStats($days);
        
        return response()->json([
            'success' => true,
            'period_days' => $days,
            'analytics' => $stats,
        ]);
    }

    /**
     * Get question-level analytics (for admin use)
     */
    public function getQuestionAnalytics(): JsonResponse
    {
        $questionStats = SampleQuizAssessment::getQuestionAnalytics();

        return response()->json([
            'success' => true,
            'question_analytics' => $questionStats,
        ]);
    }

    /**
     * Get domain-level analytics
     */
    public function getDomainAnalytics(): JsonResponse
    {
        $domainStats = SampleQuizResponse::getDomainAnalytics();

        return response()->json([
            'success' => true,
            'domain_analytics' => $domainStats,
        ]);
    }

    /**
     * Get difficulty-level analytics
     */
    public function getDifficultyAnalytics(): JsonResponse
    {
        $difficultyStats = SampleQuizResponse::getDifficultyAnalytics();

        return response()->json([
            'success' => true,
            'difficulty_analytics' => $difficultyStats,
        ]);
    }

    /**
     * Get Bloom level analytics
     */
    public function getBloomAnalytics(): JsonResponse
    {
        $bloomStats = SampleQuizResponse::getBloomAnalytics();

        return response()->json([
            'success' => true,
            'bloom_analytics' => $bloomStats,
        ]);
    }

    /**
     * Legacy endpoint for backward compatibility - stores all responses at once
     * TODO: Remove after frontend migration is complete
     */
    public function storeCompletion(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'session_id' => 'required|string|max:100',
                'responses' => 'required|array',
                'responses.*.question_id' => 'required|integer',
                'responses.*.selected_options' => 'required|array',
                'responses.*.is_correct' => 'required|boolean',
                'responses.*.response_time' => 'nullable|integer|min:0',
                'score' => 'required|integer|min:0|max:100',
                'completion_time_seconds' => 'required|integer|min:0',
                'questions_count' => 'required|integer|min:1',
                'started_at' => 'nullable|date',
            ]);

            // Check if assessment already exists
            $existingAssessment = SampleQuizAssessment::where('session_id', $validated['session_id'])->first();
            if ($existingAssessment && $existingAssessment->status === 'completed') {
                DB::rollBack();
                return response()->json([
                    'success' => true,
                    'message' => 'Session already recorded',
                    'session_id' => $validated['session_id']
                ]);
            }

            // Create or update assessment
            $assessment = $existingAssessment ?: SampleQuizAssessment::create([
                'session_id' => $validated['session_id'],
                'total_questions' => $validated['questions_count'],
                'score' => $validated['score'],
                'completion_time_seconds' => $validated['completion_time_seconds'],
                'status' => 'completed',
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'started_at' => $validated['started_at'] ? now()->parse($validated['started_at']) : now(),
                'completed_at' => now(),
            ]);

            // Store individual responses
            foreach ($validated['responses'] as $index => $responseData) {
                SampleQuizResponse::create([
                    'sample_quiz_assessment_id' => $assessment->id,
                    'question_id' => $responseData['question_id'],
                    'question_sequence' => $index + 1,
                    'selected_options' => $responseData['selected_options'],
                    'is_correct' => $responseData['is_correct'],
                    'response_time_seconds' => $responseData['response_time'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sample quiz completion recorded successfully',
                'session_id' => $assessment->session_id,
                'score' => $assessment->score,
            ]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Invalid data provided',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Legacy completion error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to record sample quiz completion',
            ], 500);
        }
    }

    /**
     * Get sample quiz questions for frontend (public endpoint)
     */
    public function getQuestions(): JsonResponse
    {
        try {
            // Get sample quiz questions in display order
            $sampleQuestions = \App\Models\SampleQuizQuestion::with([
                    'diagnosticItem.subtopic.topic.domain',
                    'diagnosticItem.type'
                ])
                ->orderBy('display_order')
                ->get()
                ->map(function ($sq, $index) {
                    $item = $sq->diagnosticItem;
                    
                    return [
                        'id' => $item->id,
                        'type_id' => $item->type_id,
                        'question_type' => [
                            'id' => $item->type_id,
                            'name' => $item->type->name ?? 'Unknown',
                            'code' => strtolower(str_replace(' ', '_', $item->type->name ?? 'unknown'))
                        ],
                        'content' => $item->content,
                        'options' => is_string($item->options) ? json_decode($item->options, true) : $item->options,
                        'correct_options' => is_string($item->correct_options) ? json_decode($item->correct_options, true) : $item->correct_options,
                        'justifications' => is_string($item->justifications) ? json_decode($item->justifications, true) : $item->justifications,
                        'domain' => $item->subtopic->topic->domain->name ?? 'Unknown',
                        'topic' => $item->subtopic->topic->name ?? 'Unknown',
                        'difficulty' => $this->mapDifficultyLevel($item->difficulty_level),
                        'bloom' => $this->mapBloomLevel($item->bloom_level),
                        'dimension' => $item->dimension ?? 'Technical',
                        'settings' => is_string($item->settings) ? json_decode($item->settings, true) : $item->settings,
                    ];
                });

            return response()->json([
                'success' => true,
                'questions' => $sampleQuestions,
                'total' => $sampleQuestions->count(),
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to get sample quiz questions: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to load sample quiz questions',
                'questions' => [],
                'total' => 0,
            ], 500);
        }
    }

    /**
     * Map difficulty level number to string
     */
    private function mapDifficultyLevel(int $level): string
    {
        return match($level) {
            1 => 'Easy',
            2 => 'Easy',
            3 => 'Medium', 
            4 => 'Medium',
            5 => 'Hard',
            6 => 'Expert',
            default => 'Medium'
        };
    }

    /**
     * Map bloom level number to string
     */
    private function mapBloomLevel(int $level): string
    {
        return match($level) {
            1 => 'Remember',
            2 => 'Understand', 
            3 => 'Apply',
            4 => 'Analyze',
            5 => 'Evaluate',
            6 => 'Create',
            default => 'Apply'
        };
    }
}