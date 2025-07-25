<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use App\Services\DataAnonymizationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PrivacyController extends Controller
{
    protected DataAnonymizationService $anonymizationService;

    public function __construct(DataAnonymizationService $anonymizationService)
    {
        $this->anonymizationService = $anonymizationService;
    }

    /**
     * Display privacy policy.
     */
    public function policy(): Response
    {
        return Inertia::render('Legal/PrivacyPolicy', [
            'lastUpdated' => '2024-01-01',
            'contactEmail' => config('mail.from.address'),
        ]);
    }

    /**
     * Display terms of service.
     */
    public function terms(): Response
    {
        return Inertia::render('Legal/TermsOfService', [
            'lastUpdated' => '2024-01-01',
            'companyName' => config('app.company_name', 'Academy'),
        ]);
    }

    /**
     * Display cookie policy.
     */
    public function cookies(): Response
    {
        return Inertia::render('Legal/CookiePolicy', [
            'lastUpdated' => '2024-01-01',
            'cookieTypes' => $this->getCookieTypes(),
        ]);
    }

    /**
     * Display refund policy.
     */
    public function refund(): Response
    {
        return Inertia::render('Legal/RefundPolicy', [
            'lastUpdated' => '2024-01-01',
            'refundPeriod' => 30,
            'contactEmail' => config('mail.support.address'),
        ]);
    }

    /**
     * Display privacy settings for authenticated users.
     */
    public function settings(Request $request): Response
    {
        $user = $request->user();
        $privacySettings = $user->privacySetting;
        $consents = $user->privacyConsents()->latest()->get();

        return Inertia::render('Legal/PrivacySettings', [
            'privacySettings' => $privacySettings,
            'consents' => $consents,
            'dataCategories' => $this->getDataCategories(),
        ]);
    }

    /**
     * Export user data (GDPR compliance).
     */
    public function exportData(Request $request): StreamedResponse
    {
        $user = $request->user();

        // Log the data export request
        // TODO: Add activity logging when package is installed
        // activity()
        //     ->performedOn($user)
        //     ->causedBy($user)
        //     ->withProperties(['action' => 'data_export_requested'])
        //     ->log('User requested data export');

        // Generate export data
        $exportData = [
            'profile' => $user->only(['name', 'email', 'created_at', 'updated_at']),
            'professional_profile' => $user->professionalProfile,
            'purchases' => $user->purchases()->with('product')->get(),
            'assessments' => $user->assessments()->get(),
            'study_progress' => [
                'topics' => $user->topicProgress()->get(),
                'lessons' => $user->lessonProgress()->get(),
                'courses' => $user->courseProgress()->get(),
            ],
            'achievements' => $user->achievements()->with('achievementDefinition')->get(),
            'social_activities' => $user->socialActivities()->get(),
            'privacy_consents' => $user->privacyConsents()->get(),
        ];

        $filename = 'user-data-export-'.$user->id.'-'.now()->format('Y-m-d').'.json';

        return response()->streamDownload(function () use ($exportData) {
            echo json_encode($exportData, JSON_PRETTY_PRINT);
        }, $filename, [
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Request data deletion (GDPR compliance).
     */
    public function deleteData(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|current_password',
            'confirmation' => 'required|in:DELETE',
        ]);

        $user = $request->user();

        // Log the deletion request
        // TODO: Add activity logging when package is installed
        // activity()
        //     ->performedOn($user)
        //     ->causedBy($user)
        //     ->withProperties(['action' => 'data_deletion_requested'])
        //     ->log('User requested data deletion');

        // Anonymize user data instead of hard delete
        $this->anonymizationService->anonymizeUser($user);

        // Log out the user
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Your data has been successfully deleted.');
    }

    /**
     * Get cookie types for the policy.
     */
    private function getCookieTypes(): array
    {
        return [
            [
                'name' => 'Essential Cookies',
                'description' => 'Required for the website to function properly',
                'required' => true,
                'cookies' => [
                    'laravel_session' => 'Maintains user session',
                    'XSRF-TOKEN' => 'Security token for form submissions',
                ],
            ],
            [
                'name' => 'Analytics Cookies',
                'description' => 'Help us understand how visitors use our website',
                'required' => false,
                'cookies' => [
                    '_ga' => 'Google Analytics tracking',
                    '_gid' => 'Google Analytics user identification',
                ],
            ],
            [
                'name' => 'Marketing Cookies',
                'description' => 'Used to deliver relevant advertisements',
                'required' => false,
                'cookies' => [
                    '_fbp' => 'Facebook Pixel tracking',
                ],
            ],
        ];
    }

    /**
     * Get data categories for privacy settings.
     */
    private function getDataCategories(): array
    {
        return [
            [
                'id' => 'profile',
                'name' => 'Profile Information',
                'description' => 'Your name, email, and profile details',
                'deletable' => false,
            ],
            [
                'id' => 'learning',
                'name' => 'Learning Progress',
                'description' => 'Your course progress, quiz scores, and certificates',
                'deletable' => false,
            ],
            [
                'id' => 'social',
                'name' => 'Social Activities',
                'description' => 'Your posts, comments, and social interactions',
                'deletable' => true,
            ],
            [
                'id' => 'analytics',
                'name' => 'Usage Analytics',
                'description' => 'Anonymous data about how you use the platform',
                'deletable' => true,
            ],
        ];
    }

    /**
     * Get consent status for cookie banner.
     */
    public function getConsentStatus(Request $request)
    {
        // Only for authenticated users
        if (! auth()->check()) {
            // Return default response for non-authenticated users
            return response()->json([
                'consent_given' => false,
                'consent_date' => null,
                'categories' => [
                    'strictly_necessary' => true,
                    'functional' => false,
                    'analytics' => false,
                    'marketing' => false,
                ],
                'needs_consent' => false, // Don't force banner for non-authenticated users
                'user_id' => null,
            ]);
        }

        try {
            $user = auth()->user();
            $consentStatus = $user->getConsentStatus();
            $needsConsent = $user->needsConsent();

            return response()->json([
                'consent_given' => $consentStatus['consent_given'],
                'consent_date' => $consentStatus['consent_date'],
                'categories' => $consentStatus['categories'],
                'needs_consent' => $needsConsent,
                'user_id' => $user->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting consent status: '.$e->getMessage());

            return response()->json([
                'error' => 'Failed to get consent status',
                'consent_given' => false,
                'consent_date' => null,
                'categories' => [
                    'strictly_necessary' => true,
                    'functional' => false,
                    'analytics' => false,
                    'marketing' => false,
                ],
                'needs_consent' => false,
                'user_id' => null,
            ], 500);
        }
    }

    /**
     * Store cookie consent from cookie banner.
     */
    public function storeCookieConsent(Request $request)
    {
        $validated = $request->validate([
            'necessary_cookies' => 'required|boolean',
            'analytics_cookies' => 'required|boolean',
            'functional_cookies' => 'required|boolean',
            'marketing_cookies' => 'required|boolean',
        ]);

        // For unauthenticated users, return success (they handle consent via localStorage)
        if (! auth()->check()) {
            return response()->json([
                'success' => true,
                'message' => 'Cookie consent saved locally for anonymous user',
                'consent' => [
                    'consent_given' => true,
                    'consent_date' => now()->toISOString(),
                    'categories' => [
                        'strictly_necessary' => $validated['necessary_cookies'],
                        'functional' => $validated['functional_cookies'],
                        'analytics' => $validated['analytics_cookies'],
                        'marketing' => $validated['marketing_cookies'],
                    ],
                ],
                'user_authenticated' => false,
            ]);
        }

        // For authenticated users, save to database
        $user = auth()->user();

        // Map cookie preferences to GDPR consent structure
        $consentPreferences = [
            'strictly_necessary' => $validated['necessary_cookies'],
            'functional' => $validated['functional_cookies'],
            'analytics' => $validated['analytics_cookies'],
            'marketing' => $validated['marketing_cookies'],
            'cookie_consent_given' => true,
            'cookie_consent_date' => now()->toISOString(),
        ];

        // Create or update GDPR consent record
        $user->privacyConsents()->updateOrCreate(
            [
                'regulation' => 'GDPR',
            ],
            [
                'consent_version' => config('privacy.versions.GDPR', '1.0'),
                'is_consent_given' => true,
                'consent_given_at' => now(),
                'consent_preferences' => $consentPreferences,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'consent_region' => $user->profile?->country_code,
            ]
        );

        // Log the consent update
        // TODO: Add activity logging when package is installed
        // activity()
        //     ->performedOn($user)
        //     ->causedBy($user)
        //     ->withProperties(['consent_preferences' => $consentPreferences])
        //     ->log('User updated cookie consent preferences');

        return response()->json([
            'success' => true,
            'message' => 'Cookie consent preferences saved successfully',
            'consent' => [
                'consent_given' => true,
                'consent_date' => now()->toISOString(),
                'categories' => [
                    'strictly_necessary' => $validated['necessary_cookies'],
                    'functional' => $validated['functional_cookies'],
                    'analytics' => $validated['analytics_cookies'],
                    'marketing' => $validated['marketing_cookies'],
                ],
            ],
            'user_authenticated' => true,
        ]);
    }

    /**
     * Show the privacy consent form.
     */
    public function showConsent(Request $request): Response
    {
        $user = $request->user();
        $regulation = 'GDPR'; // Default to GDPR, can be expanded based on user's region
        $consentVersion = config('privacy.versions.GDPR', '1.0');

        return Inertia::render('Privacy/Consent', [
            'user' => $user,
            'regulation' => $regulation,
            'consentVersion' => $consentVersion,
            'privacyPolicyUrl' => route('privacy.policy'),
            'termsUrl' => route('terms'),
        ]);
    }

    /**
     * Store the privacy consent.
     */
    public function storeConsent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'regulation' => 'required|string|in:GDPR,CCPA',
            'consent_given' => 'required|boolean|accepted',
        ]);

        $user = $request->user();

        // Create or update GDPR consent record
        $user->privacyConsents()->updateOrCreate(
            [
                'regulation' => $validated['regulation'],
            ],
            [
                'consent_version' => config('privacy.versions.'.$validated['regulation'], '1.0'),
                'is_consent_given' => true,
                'consent_given_at' => now(),
                'consent_preferences' => [
                    'strictly_necessary' => true,
                    'functional' => true,
                    'analytics' => true,
                    'marketing' => false,
                    'cookie_consent_given' => true,
                    'cookie_consent_date' => now()->toISOString(),
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'consent_region' => $user->profile?->country_code,
            ]
        );

        // Redirect to intended URL or dashboard
        $intendedUrl = session()->pull('url.intended', route('dashboard'));

        return redirect($intendedUrl)
            ->with('success', 'Thank you for accepting our privacy policy.');
    }
}
