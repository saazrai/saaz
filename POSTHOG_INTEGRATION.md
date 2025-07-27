# PostHog Integration - Saaz Academy

## Overview

PostHog has been integrated into Saaz Academy to provide comprehensive product analytics, including user behavior tracking, feature flags, session recordings, and advanced funnel analysis specifically tailored for educational platforms.

## 🎯 Why PostHog for Educational Analytics?

- **User Journey Analysis**: Track complete learning pathways through assessments
- **Feature Flags**: A/B test educational content and UI changes
- **Session Recordings**: Understand how users interact with quiz interfaces
- **Cohort Analysis**: Analyze learning outcomes across user segments
- **Retention Analysis**: Track student engagement and course completion rates
- **Advanced Funnels**: Analyze assessment completion and conversion rates

## ⚙️ Configuration

### Environment Variables

Add these to your `.env` file:

```env
# PostHog Analytics - Product Analytics & Feature Flags
POSTHOG_API_KEY=your_posthog_api_key_here
POSTHOG_HOST=https://app.posthog.com
POSTHOG_PROJECT_ID=your_project_id
POSTHOG_ENABLED=true
```

### Getting PostHog Credentials

1. **Sign up** at [PostHog Cloud](https://app.posthog.com/signup) or use self-hosted instance
2. **Create a project** for Saaz Academy
3. **Copy API Key** from Project Settings → API Keys
4. **Get Project ID** from Project Settings → General

## 🚀 Features Implemented

### 🔒 Privacy-First Implementation

- **Development Mode**: Disabled when `APP_DEBUG=true`
- **Data Minimization**: Only essential educational data collected
- **Masked Inputs**: Passwords and sensitive data automatically masked
- **Session Recording Controls**: Configurable recording settings
- **GDPR Compliant**: Built-in privacy controls

### 📊 Automatic Tracking

- **Page Views**: All route navigation automatically tracked
- **User Sessions**: Session duration and engagement metrics
- **Feature Usage**: Automatic UI interaction capture
- **Error Tracking**: JavaScript errors and user experience issues

### 🎓 Educational Event Tracking

The `PostHogService` provides specialized methods for educational analytics:

#### Assessment Events
```php
// Track diagnostic assessment start
PostHogService::trackDiagnosticStart($userId, $diagnosticId, $phase);

// Track assessment completion
PostHogService::trackDiagnosticComplete($userId, $diagnosticId, $score, $totalQuestions, $duration);

// Track phase completion
PostHogService::trackPhaseComplete($userId, $phase, $score, $questionsAnswered);

// Track individual question interactions
PostHogService::trackQuestionAnswered($userId, $questionId, $isCorrect, $responseTime, $questionType);
```

#### User Lifecycle Events
```php
// Track user registration
PostHogService::trackUserRegistration($userId, $method); // 'email', 'google', etc.

// Identify user with properties
PostHogService::identify($userId, PostHogService::getUserProperties($user));

// Track feature usage
PostHogService::trackFeatureUsage($userId, 'dark_mode_toggle', ['previous_theme' => 'light']);
```

### 🎛️ Advanced Features

#### Feature Flags
```javascript
// In Vue components
if (posthog.isFeatureEnabled('new-quiz-interface')) {
    // Show new interface
}

// With payloads
const quizConfig = posthog.getFeatureFlagPayload('quiz-configuration');
```

#### Session Recordings
- **Automatically enabled** for all users (with privacy controls)
- **Masked sensitive inputs** (passwords, emails if configured)
- **Console logs captured** for debugging user issues
- **Network requests tracked** for performance analysis

#### Cohort Analysis
- **Score-based cohorts**: Group users by assessment performance
- **Registration method cohorts**: Compare email vs social sign-ups  
- **Engagement cohorts**: Active vs passive learners
- **Geographic cohorts**: Performance by region

## 📈 Key Metrics Tracked

### Learning Analytics
- **Assessment Start Rate**: How many users start vs visit
- **Completion Funnel**: Drop-off points in assessments
- **Score Distribution**: Performance across user segments
- **Time-to-Complete**: Assessment duration analysis
- **Question Difficulty**: Which questions cause most errors
- **Learning Paths**: Successful vs unsuccessful user journeys

### Product Analytics
- **Feature Adoption**: Which features drive engagement
- **UI Interaction Heat Maps**: Most/least used interface elements
- **Page Performance**: Load times and user experience
- **Error Rates**: Technical issues affecting learning
- **Mobile vs Desktop**: Platform-specific behavior patterns

### Business Metrics
- **User Retention**: Daily/weekly/monthly active users
- **Conversion Funnel**: Guest → Registration → Assessment completion
- **Feature Usage**: Premium feature adoption rates
- **Support Metrics**: Common user issues and pain points

## 🛠️ Implementation Examples

### In Controllers

```php
use App\Services\PostHogService;

class DiagnosticController extends Controller
{
    public function start(Request $request)
    {
        $diagnostic = Diagnostic::create([...]);
        
        // Track diagnostic start
        if (auth()->check()) {
            PostHogService::trackDiagnosticStart(
                auth()->id(), 
                $diagnostic->id,
                $request->get('phase')
            );
        }
        
        return redirect()->route('diagnostic.show', $diagnostic);
    }
    
    public function submit(Request $request, Diagnostic $diagnostic)
    {
        // Process submission...
        
        // Track completion
        PostHogService::trackDiagnosticComplete(
            auth()->id(),
            $diagnostic->id,
            $diagnostic->score,
            $diagnostic->total_questions,
            $diagnostic->total_duration_seconds
        );
        
        return redirect()->route('diagnostic.results', $diagnostic);
    }
}
```

### In Vue Components

```javascript
// Track feature interactions
export default {
    methods: {
        toggleDarkMode() {
            // Toggle logic...
            
            // Track feature usage
            if (typeof posthog !== 'undefined') {
                posthog.capture('dark_mode_toggled', {
                    new_theme: this.isDark ? 'dark' : 'light',
                    page: this.$route.name
                });
            }
        },
        
        answerQuestion(questionId, answer) {
            // Answer logic...
            
            // Track question interaction
            posthog.capture('question_answered', {
                question_id: questionId,
                question_type: this.question.type,
                response_time: this.getResponseTime(),
                page: 'diagnostic_quiz'
            });
        }
    }
}
```

### Middleware Integration

```php
// In HandleInertiaRequests middleware
public function share(Request $request)
{
    return array_merge(parent::share($request), [
        'posthog' => [
            'enabled' => PostHogService::isEnabled(),
            'config' => PostHogService::getConfig(),
        ],
        'user' => $request->user() ? [
            'id' => $request->user()->id,
            'properties' => PostHogService::getUserProperties($request->user()),
        ] : null,
    ]);
}
```

## 🎭 A/B Testing Examples

### Quiz Interface Testing
```javascript
// Test different quiz layouts
const quizLayout = posthog.getFeatureFlag('quiz-layout-test');

if (quizLayout === 'cards') {
    // Show card-based selection
} else if (quizLayout === 'traditional') {
    // Show traditional radio buttons
}
```

### Onboarding Flow Testing
```php
// In controller
$onboardingFlow = PostHogService::getFeatureFlag($userId, 'onboarding-flow');

if ($onboardingFlow === 'guided') {
    return view('onboarding.guided');
} else {
    return view('onboarding.standard');
}
```

## 📊 Dashboard Setup

### Recommended PostHog Dashboards

1. **Learning Analytics Dashboard**
   - Assessment completion rates
   - Average scores by domain
   - Time-to-complete trends
   - Question difficulty analysis

2. **User Engagement Dashboard**
   - Daily/Weekly active users
   - Feature adoption rates
   - Session duration trends
   - Page view patterns

3. **Product Performance Dashboard**
   - Page load times
   - Error rates
   - Mobile vs desktop usage
   - Browser compatibility issues

### Custom Insights

```javascript
// Example custom insight queries
// Assessment Funnel
events: [
  'diagnostic_started',
  'diagnostic_completed'
]

// Feature Adoption
events: [
  'feature_used'
]
filters: [
  'feature_name = "dark_mode_toggle"'
]
```

## 🔐 Privacy & Compliance

### Data Collection Principles
- **Minimal Data**: Only collect data necessary for product improvement
- **User Consent**: Respect user privacy preferences
- **Data Retention**: Automatic cleanup of old session recordings
- **Anonymization**: IP addresses and sensitive data masked

### GDPR Compliance Features
- **Data Export**: Users can request their data
- **Data Deletion**: Right to be forgotten implementation
- **Consent Management**: Granular privacy controls
- **Processing Lawful Basis**: Legitimate interest for product improvement

## 🚨 Troubleshooting

### Common Issues

1. **PostHog Not Loading**
   ```bash
   # Check environment variables
   php artisan tinker
   >>> config('services.posthog')
   ```

2. **Events Not Tracking**
   ```javascript
   // Check browser console
   console.log(window.posthog);
   
   // Verify API key
   posthog.debug();
   ```

3. **Session Recordings Not Working**
   - Check Content Security Policy allows PostHog domains
   - Verify session recording is enabled in project settings
   - Check browser privacy settings

### Debug Mode

```php
// Enable debug logging
PostHogService::track($userId, 'test_event', ['debug' => true]);
```

```javascript
// Frontend debugging
posthog.debug();
posthog.capture('test_event', {debug: true});
```

## 🚀 Future Enhancements

### Planned Features
1. **Advanced Cohort Analysis**: Learning outcome prediction
2. **Real-time Dashboards**: Live assessment monitoring
3. **Automated Insights**: AI-powered learning recommendations
4. **Integration APIs**: Connect with LMS systems
5. **Advanced A/B Testing**: Multi-variant educational content testing

### Custom Event Ideas
- **Study Session Tracking**: Time spent in learning modes
- **Help System Usage**: Which help features are most valuable
- **Error Recovery**: How users recover from mistakes
- **Social Features**: Collaboration and sharing patterns
- **Mobile Optimization**: Touch interaction analysis

## 📞 Support

For PostHog integration issues:
- [PostHog Documentation](https://posthog.com/docs)
- [PostHog Community](https://posthog.com/slack)
- Internal team: Check Laravel logs for PostHog service errors

## 🎓 Educational Analytics Best Practices

1. **Track Learning Outcomes**: Focus on metrics that improve education
2. **Respect Privacy**: Be transparent about data collection
3. **Act on Insights**: Use data to enhance learning experience
4. **Iterate Quickly**: A/B test educational content improvements
5. **Monitor Performance**: Ensure analytics don't impact learning speed