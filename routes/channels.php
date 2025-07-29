<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Admin presence channel - track online admins
Broadcast::channel('admin.presence', function ($user) {
    \Log::info('Admin presence channel auth attempt', [
        'user_id' => $user?->id,
        'user_roles' => $user?->roles->pluck('name')->toArray() ?? [],
    ]);
    
    if ($user && $user->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->profile_photo_url ?? null,
        ];
    }
    
    return false;
});

// Admin notifications channel
Broadcast::channel('admin.notifications', function ($user) {
    \Log::info('Admin notifications channel auth', ['user_id' => $user?->id]);
    return $user && $user->hasAnyRole(['super-admin', 'admin', 'moderator']);
});

// Admin user-specific channel
Broadcast::channel('admin.users.{userId}', function ($user, $userId) {
    \Log::info('Admin user channel auth', ['user_id' => $user?->id, 'target_id' => $userId]);
    return $user && $user->hasAnyRole(['super-admin', 'admin', 'moderator']) && (int) $user->id === (int) $userId;
});

// Admin activity channel for real-time updates
Broadcast::channel('admin.activity', function ($user) {
    \Log::info('Admin activity channel auth', ['user_id' => $user?->id]);
    return $user && $user->hasAnyRole(['super-admin', 'admin', 'moderator']);
});

// Channels that AdminLayout expects
Broadcast::channel('online-users', function ($user) {
    \Log::info('Online users channel auth attempt', [
        'user_id' => $user?->id,
        'user_roles' => $user?->roles->pluck('name')->toArray() ?? [],
    ]);
    
    if ($user && $user->hasAnyRole(['super-admin', 'admin', 'moderator'])) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->profile_photo_url ?? null,
        ];
    }
    
    return false;
});

Broadcast::channel('admin-dashboard', function ($user) {
    \Log::info('Admin dashboard channel auth', ['user_id' => $user?->id]);
    return $user && $user->hasAnyRole(['super-admin', 'admin', 'moderator']);
});

Broadcast::channel('quiz-attempts', function ($user) {
    \Log::info('Quiz attempts channel auth', ['user_id' => $user?->id]);
    return $user && $user->hasAnyRole(['super-admin', 'admin', 'moderator']);
});

Broadcast::channel('purchase-notifications', function ($user) {
    \Log::info('Purchase notifications channel auth', ['user_id' => $user?->id]);
    return $user && $user->hasAnyRole(['super-admin', 'admin', 'moderator']);
});
