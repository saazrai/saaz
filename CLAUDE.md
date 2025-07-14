# CLAUDE.md - SecureStart™ V1 Diagnostics Platform

## 🚨 CRITICAL RULES - ALWAYS FOLLOW

### 0. V1 SCOPE ENFORCEMENT
🚨 **ONLY BUILD V1 DIAGNOSTIC FEATURES** 🚨
- ✅ Diagnostic assessments (20 domains)
- ✅ User authentication (email + Google OAuth)
- ✅ Results & reports with domain breakdowns
- ✅ Basic admin panel (user management only)
- ✅ Dark/light theme system
- ✅ Privacy compliance (GDPR)
- ❌ **NO** study notes, presentations, learning management
- ❌ **NO** e-commerce, payments, courses, social features
- ❌ **NO** complex admin features beyond user management
```

### 2. AUTHENTICATION - DUAL PATH STRATEGY
🔐 **SOCIAL + EMAIL/PASSWORD** 🔐
- Laravel Breeze + Laravel Socialite (Google only for V1)
- NO Facebook, Twitter, LinkedIn in V1 - keep it simple
- Guest sessions convert to user accounts seamlessly
- Use middleware strategically: auth required for results, not assessments

**Route Pattern:**
```php
// Guest-accessible assessment routes (NO auth middleware)
Route::prefix('assessments')->name('assessments.')->group(function () {
    Route::get('/', [AssessmentController::class, 'index'])->name('index');
    Route::post('/start', [AssessmentController::class, 'start'])->name('start');
    Route::post('/{assessment}/answer', [AssessmentController::class, 'answer'])->name('answer');
});

// Auth-required routes (detailed results)
Route::middleware('auth')->group(function () {
    Route::get('/assessments/{assessment}/results', [AssessmentController::class, 'results']);
});
```

### 3. THEME SYSTEM - CSS VARIABLES ARCHITECTURE
🎨 **MANDATORY CSS VARIABLE SYSTEM** 🎨
- ALWAYS use CSS variables for theming (copy from current project)
- Theme toggle with localStorage persistence
- NO hardcoded colors in components
- Support system dark mode preference detection

**Required CSS Structure:**
```css
:root {
    /* Light theme variables */
    --bg-primary: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    --text-primary: #2c3e50;
    --accent-primary: #2980b9;
}

[data-theme="dark"] {
    /* Dark theme overrides */
    --bg-primary: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    --text-primary: #e8e8e8;
    --accent-primary: #3498db;
}
```

### 4. UI/UX - APPLE DESIGN PRINCIPLES
🍎 **APPLE-STYLE INTERFACE MANDATORY** 🍎
- Glassmorphism effects (backdrop-filter: blur)
- Rounded corners (border-radius: 15px minimum)
- Professional gradients, NO flat colors
- Subtle shadows and animations
- System fonts (-apple-system, BlinkMacSystemFont)

**Component Standards:**
```css
.assessment-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}
```

### 5. MOBILE-FIRST RESPONSIVE DESIGN
📱 **MOBILE RESPONSIVENESS IS NON-NEGOTIABLE** 📱
- Design for mobile first, enhance for desktop
- Touch-friendly navigation (44px minimum touch targets)
- Swipe gestures for assessment navigation
- Responsive typography scaling
- Safe area insets for iOS devices

### 6. ASSESSMENT FLOW - USER EXPERIENCE PRIORITY
🎯 **OPTIMIZE FOR CONVERSION** 🎯

**Required User Journey:**
1. **Landing Page** → "Start Free Assessment" (prominent CTA)
2. **Assessment** → 15-20 questions, progress indicator, NO interruptions
3. **Basic Results** → Immediate score display ("73% - Intermediate")
4. **Conversion Point** → "Register for detailed analysis" (value proposition)
5. **Detailed Results** → Domain breakdowns, recommendations, PDF export

**UX Rules:**
- NO signup barriers before assessment
- Show progress clearly (Question 3 of 15)
- Immediate gratification (basic score)
- Clear value proposition for registration
- Professional results presentation

### 7. PERFORMANCE - SPEED IS FEATURES
⚡ **SUB-2 SECOND PAGE LOADS** ⚡
- Use Vite for optimized builds
- Lazy load non-critical components
- Optimize images and assets
- Database query optimization
- CDN for static assets

### 8. SECURITY - ENTERPRISE STANDARDS
🛡️ **ENTERPRISE-GRADE SECURITY** 🛡️
- CSRF protection on ALL forms (never disable)
- Rate limiting on auth endpoints
- Input validation and sanitization
- HTTPS everywhere with HSTS
- Secure session management

**Security Checklist:**
- [ ] CSRF tokens in all forms
- [ ] SQL injection protection (parameterized queries)
- [ ] XSS prevention (escaped outputs)
- [ ] Rate limiting on login/registration
- [ ] Secure password requirements
- [ ] Session timeout handling

### 9. ADMIN PANEL - MINIMAL & FOCUSED
👤 **BASIC ADMIN ONLY** 👤
- User management (list, view, disable)
- Assessment monitoring (completion rates, scores)
- Question bank management (CRUD only)
- NO complex analytics, NO advanced features in V1

### 10. PRIVACY & COMPLIANCE - GDPR READY
🔒 **PRIVACY BY DESIGN** 🔒
- Minimal data collection
- Clear consent flows
- Data export capabilities
- Secure deletion workflows
- Privacy policy and cookie consent

## 📁 PROJECT STRUCTURE

```
/
├── app/
│   ├── Http/Controllers/
│   │   ├── AssessmentController.php
│   │   ├── Auth/ (Breeze + Social)
│   │   └── Admin/UserController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Assessment.php
│   │   ├── AssessmentQuestion.php
│   │   └── AssessmentResult.php
├── resources/
│   ├── js/
│   │   ├── Pages/
│   │   │   ├── Assessment/
│   │   │   ├── Auth/
│   │   │   └── Admin/
│   │   └── Components/
│   ├── css/
│   │   ├── app.css
│   │   └── theme.css (CSS variables)
├── database/
│   ├── migrations/
│   └── seeders/Diagnostics/D1_Seeder.php
└── routes/
    ├── web.php (main routes)
    └── admin.php (admin routes)
    └── api.php (api routes)
```

## 🎯 DEVELOPMENT PRIORITIES

### **Priority 1: Core Assessment Flow**
1. Diagnostics assessment capability
2. Question bank with 20 diagnostics domains
3. Basic scoring algorithm
4. Immediate results display

### **Priority 2: Authentication & Conversion**
1. Email + Google OAuth setup
2. Guest-to-user conversion flow
3. Detailed results for registered users
4. User dashboard

### **Priority 3: Polish & Performance**
1. Dark/light theme implementation
2. Mobile responsiveness
3. Performance optimization
4. Security hardening

## 🚫 WHAT NOT TO BUILD

### **Explicitly Forbidden in V1:**
- Study notes or educational content
- Presentation systems or slide layouts
- E-commerce or payment processing
- Social features or user interactions
- Complex admin analytics
- Multiple assessment types
- Learning management features
- Course or lesson structures



## 📊 SUCCESS METRICS

### **Technical KPIs**
- Page load speed: <2 seconds
- Mobile responsiveness: 100% Google PageSpeed
- Assessment completion rate: >85%
- Guest-to-registration conversion: >35%

### **Code Quality**
- Test coverage: >80%
- No critical security vulnerabilities
- PSR-12 coding standards
- TypeScript strict mode

## 🎨 DESIGN TOKENS

### **Colors** (CSS Variables)
```css
--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
--success-color: #10b981;
--warning-color: #f59e0b;
--error-color: #ef4444;
--text-primary: #1f2937;
--text-secondary: #6b7280;
```

### **Typography**
```css
--font-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
--text-xs: 0.75rem;
--text-sm: 0.875rem;
--text-base: 1rem;
--text-lg: 1.125rem;
--text-xl: 1.25rem;
--text-2xl: 1.5rem;
```

### **Spacing**
```css
--spacing-unit: 0.25rem; /* 4px base unit */
--spacing-sm: calc(var(--spacing-unit) * 2); /* 8px */
--spacing-md: calc(var(--spacing-unit) * 4); /* 16px */
--spacing-lg: calc(var(--spacing-unit) * 6); /* 24px */
--spacing-xl: calc(var(--spacing-unit) * 8); /* 32px */
```

---

## 📋 PRE-DEVELOPMENT CHECKLIST

Before writing any code, ensure:

- [ ] PRD.md has been reviewed
- [ ] Database schema supports guest assessments (nullable user_id)
- [ ] Authentication flow supports both email and Google OAuth
- [ ] Theme system architecture is planned (CSS variables)
- [ ] Mobile-first responsive approach is confirmed
- [ ] Security requirements are understood
- [ ] Performance targets are clear (<2s page loads)
- [ ] V1 scope boundaries are established (no study notes/LMS features)

## 🎯 REMEMBER: FOCUS ON VALUE

**The Goal**: Create a professional diagnostic platform that converts visitors into qualified leads through exceptional UX and immediate value delivery. Every feature must serve this primary objective.

**When in doubt**: Choose simplicity, focus on core value, prioritize user experience over feature complexity.