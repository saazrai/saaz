<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request): Response
    {
        $user = auth()->user();
        
        // Get user's diagnostic results
        $diagnosticResults = Diagnostic::where('user_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($diagnostic) {
                return [
                    'id' => $diagnostic->id,
                    'score' => $diagnostic->score ?? 0,
                    'total_questions' => $diagnostic->total_questions,
                    'completed_at' => $diagnostic->updated_at,
                    'duration_minutes' => $diagnostic->getDurationMinutesAttribute(),
                ];
            });
        
        // Check if user has taken any diagnostic
        $diagnosticTaken = Diagnostic::where('user_id', $user->id)->exists();
        
        // Calculate enterprise metrics
        $enterpriseMetrics = [
            'totalDiagnostics' => Diagnostic::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
            'averageScore' => Diagnostic::where('user_id', $user->id)
                ->where('status', 'completed')
                ->avg('score') ?? 0,
            'lastAssessment' => Diagnostic::where('user_id', $user->id)
                ->where('status', 'completed')
                ->latest()
                ->value('updated_at')?->diffForHumans() ?? 'N/A',
        ];
        
        // Format average score
        $enterpriseMetrics['averageScore'] = round($enterpriseMetrics['averageScore'], 1);
        
        // Recent activity
        $recentActivity = [];
        
        // Add diagnostic activities
        $recentDiagnostics = Diagnostic::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        foreach ($recentDiagnostics as $diagnostic) {
            if ($diagnostic->status === 'completed') {
                $recentActivity[] = [
                    'icon' => '✅',
                    'title' => 'Completed SecureStart™ Assessment',
                    'description' => "Score: {$diagnostic->score}%",
                    'date' => $diagnostic->updated_at,
                ];
            } else {
                $recentActivity[] = [
                    'icon' => '📝',
                    'title' => 'Started SecureStart™ Assessment',
                    'description' => "In progress",
                    'date' => $diagnostic->created_at,
                ];
            }
        }
        
        // Add user registration activity
        $recentActivity[] = [
            'icon' => '👤',
            'title' => 'Account Created',
            'description' => 'Welcome to SecureStart™',
            'date' => $user->created_at,
        ];
        
        // Sort activities by date
        usort($recentActivity, function($a, $b) {
            return $b['date']->timestamp - $a['date']->timestamp;
        });
        
        // Compliance status
        $complianceStatus = [
            'status' => 'Active',
            'gdpr' => true,
            'sox' => true,
            'hipaa' => true,
        ];
        
        return Inertia::render('Dashboard', [
            'diagnosticResults' => $diagnosticResults,
            'recentActivity' => array_slice($recentActivity, 0, 5),
            'enterpriseMetrics' => $enterpriseMetrics,
            'diagnosticTaken' => $diagnosticTaken,
            'complianceStatus' => $complianceStatus,
        ]);
    }
}