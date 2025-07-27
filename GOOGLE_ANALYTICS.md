# Google Analytics 4 Integration - Saaz Academy

## Overview

Google Analytics 4 has been successfully integrated into the Saaz Academy platform to track user interactions, assessment progress, and site performance.

## Configuration

### Environment Variables

Add these variables to your `.env` file:

```env
# Google Analytics 4 - Saaz Academy
GOOGLE_ANALYTICS_ID=G-5359K4EPMX
GOOGLE_ANALYTICS_STREAM_ID=2360896180
GOOGLE_ANALYTICS_STREAM_URL=https://saazacademy.com
GOOGLE_ANALYTICS_STREAM_NAME="Saaz Academy"
```

### Stream Details

- **Stream Name**: Saaz Academy
- **Stream URL**: https://saazacademy.com
- **Stream ID**: 2360896180
- **Measurement ID**: G-5359K4EPMX

## Features

### 🔒 Privacy-First Implementation

- **Development Mode**: Analytics disabled during development (`APP_DEBUG=true`)
- **IP Anonymization**: Automatically enabled for GDPR compliance
- **No Ad Personalization**: Google signals and ad personalization disabled
- **Consent-Aware**: Only loads when not in debug mode

### 📊 Automatic Page Tracking

- Page views tracked automatically on all routes
- Single Page Application (SPA) support via Inertia.js
- Dynamic page titles and URLs captured

### 🎯 Custom Event Tracking

The `GoogleAnalyticsService` provides methods for tracking key educational events:

#### Assessment Events
```php
// Track when user starts a diagnostic
GoogleAnalyticsService::trackDiagnosticStart($diagnosticId);

// Track when user completes a diagnostic
GoogleAnalyticsService::trackDiagnosticComplete($diagnosticId, $score);

// Track phase completion
GoogleAnalyticsService::trackPhaseComplete($phase, $score);

// Track individual question answers
GoogleAnalyticsService::trackQuestionAnswer($questionNumber, $isCorrect);
```

#### Custom Events
```php
// Track any custom event
GoogleAnalyticsService::trackEvent('event_name', [
    'parameter1' => 'value1',
    'parameter2' => 'value2'
]);
```

## Implementation Details

### Files Modified

1. **`resources/views/app.blade.php`**
   - Added Google Analytics tracking script
   - Updated Content Security Policy for GA domains

2. **`config/services.php`**
   - Added Google Analytics configuration section

3. **`.env.example`**
   - Added GA environment variables with defaults

4. **`app/Services/GoogleAnalyticsService.php`**
   - Created service class for GA management
   - Provides helper methods for event tracking

### Content Security Policy

Updated CSP to allow Google Analytics domains:
- `https://www.googletagmanager.com`
- `https://www.google-analytics.com`
- `https://analytics.google.com`
- `https://stats.g.doubleclick.net`

## Usage Examples

### In Controllers

```php
use App\Services\GoogleAnalyticsService;

// In DiagnosticController
public function start(Request $request)
{
    $diagnostic = Diagnostic::create([...]);
    
    // Track diagnostic start
    if (GoogleAnalyticsService::isEnabled()) {
        // This could be added to the view or handled via JavaScript
        session()->flash('ga_track', 
            GoogleAnalyticsService::trackDiagnosticStart($diagnostic->id)
        );
    }
    
    return redirect()->route('diagnostic.show', $diagnostic);
}
```

### In Blade Templates

```php
@if(session('ga_track'))
    {!! session('ga_track') !!}
@endif
```

### In Vue Components (via Inertia)

```javascript
// Track custom events in Vue components
if (typeof gtag !== 'undefined') {
    gtag('event', 'quiz_interaction', {
        event_category: 'engagement',
        event_label: 'answer_selected',
        question_number: this.currentQuestion
    });
}
```

## Key Metrics Tracked

### Automatic Metrics
- Page views and sessions
- User engagement time
- Bounce rate
- Geographic data (anonymized)
- Device and browser information

### Custom Educational Metrics
- Diagnostic assessment starts/completions
- Phase progression rates
- Question-level performance
- Score distributions
- Time spent on assessments

## GDPR Compliance

The implementation includes several privacy protections:

- ✅ IP anonymization enabled
- ✅ Google signals disabled
- ✅ Ad personalization disabled  
- ✅ Only loads in production environment
- ✅ Can be easily disabled via environment variables

## Testing

### Development Environment
Analytics is automatically disabled when `APP_DEBUG=true` to prevent test data from polluting production analytics.

### Production Verification
1. Set `APP_DEBUG=false` in production
2. Ensure `GOOGLE_ANALYTICS_ID` is set in production `.env`
3. Verify tracking in Google Analytics Real-time reports
4. Test custom events using browser developer tools

## Troubleshooting

### Analytics Not Loading
1. Check `APP_DEBUG` is set to `false`
2. Verify `GOOGLE_ANALYTICS_ID` is set correctly
3. Check Content Security Policy allows GA domains
4. Verify no ad blockers are interfering

### Custom Events Not Tracking
1. Ensure `gtag` function is available: `typeof gtag !== 'undefined'`
2. Check browser console for JavaScript errors
3. Verify event parameters are valid JSON
4. Use Google Analytics DebugView for real-time debugging

## Future Enhancements

Potential improvements for enhanced tracking:

1. **Enhanced E-commerce Tracking**: Track course purchases and subscriptions
2. **User Journey Analysis**: Track complete assessment pathways
3. **A/B Testing Integration**: Integrate with Google Optimize
4. **Custom Dimensions**: Add user role, subscription tier tracking
5. **Goal Conversions**: Set up conversion tracking for key actions

## Support

For issues with Google Analytics integration, contact the development team or refer to:
- [Google Analytics 4 Documentation](https://developers.google.com/analytics/devguides/collection/ga4)
- [Laravel Documentation](https://laravel.com/docs)