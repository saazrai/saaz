<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class BroadcastAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // Log to a specific file for easier debugging
        $logData = [
            'user_id' => $request->user()?->id,
            'user_name' => $request->user()?->name,
            'user_roles' => $request->user()?->roles->pluck('name')->toArray() ?? [],
            'channel' => $request->input('channel_name'),
            'socket_id' => $request->input('socket_id'),
            'auth' => $request->user() ? 'authenticated' : 'not authenticated',
            'session_id' => session()->getId(),
            'request_uri' => $request->getRequestUri(),
        ];
        
        // Write to a specific log file
        file_put_contents(storage_path('logs/broadcast-auth.log'), 
            date('Y-m-d H:i:s') . ' - ' . json_encode($logData) . PHP_EOL, 
            FILE_APPEND
        );

        if (!$request->user()) {
            Log::warning('Broadcast auth failed: No authenticated user');
            return response()->json(['error' => 'Unauthenticated'], 403);
        }

        // For debugging, let's check the channel authorization directly
        $channelName = $request->input('channel_name');
        Log::info('Checking authorization for channel: ' . $channelName);

        try {
            $result = Broadcast::auth($request);
            Log::info('Broadcast auth successful', ['result' => $result]);
            return $result;
        } catch (\Exception $e) {
            Log::error('Broadcast auth exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }
}