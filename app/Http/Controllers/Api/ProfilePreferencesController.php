<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfilePreferencesController extends Controller
{
    /**
     * Get the user's UI preferences
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();

        // Default preferences
        $defaultPreferences = [
            'theme' => 'dark',
            'admin_theme' => 'dark',
            'sidebar_collapsed' => false,
            'font_size' => 'medium',
            'animations_enabled' => true,
        ];

        // Get user preferences from the database
        $preferences = $user->ui_preferences ?? [];

        // Merge with defaults
        $mergedPreferences = array_merge($defaultPreferences, $preferences);

        return response()->json([
            'success' => true,
            'data' => $mergedPreferences,
        ]);
    }

    /**
     * Update the user's UI preferences
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'theme' => 'sometimes|required|in:light,dark',
            'admin_theme' => 'sometimes|required|in:light,dark',
            'sidebar_collapsed' => 'sometimes|required|boolean',
            'font_size' => 'sometimes|required|in:small,medium,large',
            'animations_enabled' => 'sometimes|required|boolean',
        ]);

        $user = $request->user();

        // Get existing preferences
        $preferences = $user->ui_preferences ?? [];

        // Update with new values
        foreach ($validated as $key => $value) {
            $preferences[$key] = $value;
        }

        // Save to database
        $user->ui_preferences = $preferences;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $preferences,
        ]);
    }
}
