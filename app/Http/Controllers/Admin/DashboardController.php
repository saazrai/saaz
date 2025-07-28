<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get statistics for the dashboard
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'new_users_today' => User::whereDate('created_at', Carbon::today())->count(),
            'new_users_week' => User::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            
            'total_assessments' => Diagnostic::count(),
            'assessments_today' => Diagnostic::whereDate('created_at', Carbon::today())->count(),
            'assessments_week' => Diagnostic::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            'completed_assessments' => Diagnostic::where('status', 'completed')->count(),
            
            'average_score' => Diagnostic::where('status', 'completed')->avg('score') ?? 0,
            'total_questions_answered' => 0, // This would need to be calculated from diagnostic_response_items if that table exists
        ];

        // Get recent activity
        $recentUsers = User::latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'created_at', 'last_login_at']);

        $recentAssessments = Diagnostic::with(['user:id,name,email'])
            ->latest()
            ->take(5)
            ->get(['id', 'user_id', 'score', 'status', 'created_at']);

        // Get assessment completion rate by day for the last 7 days
        $completionData = Diagnostic::selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(CASE WHEN status = \'completed\' THEN 1 ELSE 0 END) as completed')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('M d'),
                    'total' => $item->total,
                    'completed' => $item->completed ?? 0,
                    'completion_rate' => $item->total > 0 ? round(($item->completed / $item->total) * 100, 1) : 0,
                ];
            });

        // Get user role distribution
        $roleDistribution = User::selectRaw('COUNT(users.id) as count, roles.name as role')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_type', 'App\\Models\\User')
            ->orWhereNull('model_has_roles.model_id')
            ->groupBy('roles.name')
            ->get()
            ->map(function ($item) {
                return [
                    'role' => $item->role ?? 'No Role',
                    'count' => $item->count,
                ];
            });

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'recentAssessments' => $recentAssessments,
            'completionData' => $completionData,
            'roleDistribution' => $roleDistribution,
        ]);
    }
}