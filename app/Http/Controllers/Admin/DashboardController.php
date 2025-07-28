<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DiagnosticResponse;
use App\Models\DiagnosticResponseItem;
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
            
            'total_assessments' => DiagnosticResponse::count(),
            'assessments_today' => DiagnosticResponse::whereDate('created_at', Carbon::today())->count(),
            'assessments_week' => DiagnosticResponse::where('created_at', '>=', Carbon::now()->subWeek())->count(),
            'completed_assessments' => DiagnosticResponse::where('is_completed', true)->count(),
            
            'average_score' => DiagnosticResponse::where('is_completed', true)->avg('percentage_score') ?? 0,
            'total_questions_answered' => DiagnosticResponseItem::count(),
        ];

        // Get recent activity
        $recentUsers = User::latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'created_at', 'last_login_at']);

        $recentAssessments = DiagnosticResponse::with(['user:id,name,email'])
            ->latest()
            ->take(5)
            ->get(['id', 'user_id', 'percentage_score', 'is_completed', 'created_at']);

        // Get assessment completion rate by day for the last 7 days
        $completionData = DiagnosticResponse::selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(is_completed) as completed')
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