<template>
    <div 
        v-if="showBanner" 
        class="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 z-[10000]"
    >
        <h3 class="font-semibold mb-2 text-gray-900 dark:text-white">🍪 We Use Cookies</h3>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
            We use cookies to enhance your experience, analyze site traffic, and provide personalized content. 
            Choose your preferences below.
        </p>
        <div class="flex flex-col gap-2">
            <button 
                @click="acceptAllCookies"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition-colors"
            >
                Accept All Cookies
            </button>
            <div class="flex gap-2">
                <button 
                    @click="openCustomizeModal"
                    class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex-1"
                >
                    Customize
                </button>
                <button 
                    @click="rejectAllCookies"
                    class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-4 py-2 rounded text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex-1"
                >
                    Only Essential
                </button>
            </div>
        </div>
    </div>

    <!-- Cookie Customization Modal -->
    <div 
        v-if="showCustomizeModal" 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-[10001]"
        @click.self="closeModal"
    >
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] flex flex-col relative z-[10002]">
            <div class="sticky top-0 bg-white dark:bg-gray-800 px-6 pt-6 pb-4 border-b border-gray-200 dark:border-gray-700 rounded-t-2xl z-10">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Cookie Preferences</h2>
                    <button 
                        @click="closeModal"
                        class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 text-2xl"
                    >
                        ×
                    </button>
                </div>
            </div>
            <div class="overflow-y-auto px-6 pb-6">
                <p class="text-gray-600 dark:text-gray-300 my-6">
                    Choose which types of cookies you want to allow. Essential cookies are required for the site to function properly.
                </p>

                <div class="space-y-4">
                    <!-- Essential Cookies -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-2xl p-4 bg-gray-50 dark:bg-gray-900">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-semibold text-blue-600 dark:text-blue-400">Essential Cookies</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Always Active</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                            These cookies are necessary for the website to function and cannot be switched off.
                        </p>
                        <ul class="text-xs text-gray-500 dark:text-gray-400 list-disc list-inside">
                            <li>Session management and authentication</li>
                            <li>Security and fraud prevention</li>
                            <li>Basic site functionality</li>
                        </ul>
                    </div>

                    <!-- Performance Cookies -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-2xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-semibold text-green-600 dark:text-green-400">Performance Cookies</h3>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    v-model="preferences.performance"
                                    class="sr-only peer"
                                >
                                <div class="w-12 h-6 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:after:bg-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600 dark:peer-checked:bg-green-500"></div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                            Help us understand how visitors interact with our website through anonymous analytics.
                        </p>
                        <ul class="text-xs text-gray-500 dark:text-gray-400 list-disc list-inside">
                            <li>Google Analytics for usage statistics</li>
                            <li>Page performance monitoring</li>
                            <li>User journey analysis</li>
                        </ul>
                    </div>

                    <!-- Functional Cookies -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-2xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-semibold text-purple-600 dark:text-purple-400">Functional Cookies</h3>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    v-model="preferences.functional"
                                    class="sr-only peer"
                                >
                                <div class="w-12 h-6 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:after:bg-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600 dark:peer-checked:bg-purple-500"></div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                            Enable enhanced functionality and personalization features.
                        </p>
                        <ul class="text-xs text-gray-500 dark:text-gray-400 list-disc list-inside">
                            <li>Language and region preferences</li>
                            <li>Video player settings</li>
                            <li>Theme and display preferences</li>
                        </ul>
                    </div>

                    <!-- Marketing Cookies -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-2xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-semibold text-orange-600 dark:text-orange-400">Marketing Cookies</h3>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    v-model="preferences.marketing"
                                    class="sr-only peer"
                                >
                                <div class="w-12 h-6 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:after:bg-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-600 dark:peer-checked:bg-orange-500"></div>
                            </label>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                            Allow us to show you relevant advertising and track campaign effectiveness.
                        </p>
                        <ul class="text-xs text-gray-500 dark:text-gray-400 list-disc list-inside">
                            <li>Personalized course recommendations</li>
                            <li>Remarketing campaigns</li>
                            <li>Social media integration</li>
                        </ul>
                    </div>
                </div>

                <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button 
                        @click="saveCustomPreferences"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors flex-1"
                    >
                        Save Preferences
                    </button>
                    <button 
                        @click="acceptAllCookies"
                        class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                    >
                        Accept All
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

// Props
const props = defineProps({
    user: {
        type: Object,
        default: null
    }
});

// Reactive state
const showBanner = ref(false);
const showCustomizeModal = ref(false);

const preferences = ref({
    essential: true,
    performance: false,
    functional: false,
    marketing: false
});

// Generate or get session ID for anonymous users
const getOrCreateSessionId = () => {
    let sessionId = localStorage.getItem('anonymous_session_id');
    if (!sessionId) {
        sessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        localStorage.setItem('anonymous_session_id', sessionId);
    }
    return sessionId;
};

// Check if consent has been given
onMounted(async () => {
    // DEBUG: Force show banner (uncomment for testing)
    // showBanner.value = true;
    // return;
    
    // For authenticated users, check database first
    if (props.user && props.user.id) {
        try {
            const response = await fetch(`/legal/privacy/cookie-consent-status`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                credentials: 'include'
            });
            
            if (response.ok) {
                const consentStatus = await response.json();
                
                // If user has valid consent in database, don't show banner
                if (consentStatus.consent_given && !consentStatus.needs_consent) {
                    preferences.value = {
                        essential: consentStatus.categories.strictly_necessary,
                        performance: consentStatus.categories.analytics || false,
                        functional: consentStatus.categories.functional || false,
                        marketing: consentStatus.categories.marketing || false
                    };
                    
                    // Sync with localStorage
                    const consentData = {
                        ...preferences.value,
                        timestamp: consentStatus.consent_date,
                        version: '2.1'
                    };
                    localStorage.setItem('cookie_consent', JSON.stringify(consentData));
                    
                    // Load appropriate scripts
                    loadCookieScripts(preferences.value);
                    return; // Don't show banner
                } else {

                    showBanner.value = true;
                    return;
                }
            } else {

            }
        } catch (error) {
            console.error('🍪 Error checking consent status:', error);

        }
    }
    
    // For non-authenticated users or users needing consent, check localStorage

    const consent = localStorage.getItem('cookie_consent');

    
    if (!consent) {

        showBanner.value = true;
    } else {
        const savedPreferences = JSON.parse(consent);

        
        // Check if consent is expired (older than 2 years)
        const consentDate = new Date(savedPreferences.timestamp);
        const twoYearsAgo = new Date();
        twoYearsAgo.setFullYear(twoYearsAgo.getFullYear() - 2);
        
        if (consentDate < twoYearsAgo) {
            // Consent expired, show banner

            showBanner.value = true;
            localStorage.removeItem('cookie_consent');
        } else {
            // Valid consent, load preferences and scripts

            preferences.value = { ...preferences.value, ...savedPreferences };
            loadCookieScripts(preferences.value);
        }
    }
    

});

// Accept all cookies
function acceptAllCookies() {
    const allAccepted = {
        essential: true,
        performance: true,
        functional: true,
        marketing: true
    };
    
    saveConsentPreferences(allAccepted);
    hideBanner();
    loadCookieScripts(allAccepted);
}

// Reject all non-essential cookies
function rejectAllCookies() {
    const essentialOnly = {
        essential: true,
        performance: false,
        functional: false,
        marketing: false
    };
    
    saveConsentPreferences(essentialOnly);
    hideBanner();
    removeNonEssentialCookies();
}

// Open customize modal
function openCustomizeModal() {
    showCustomizeModal.value = true;
    showBanner.value = false;
}

// Close modal
function closeModal() {
    showCustomizeModal.value = false;
    showBanner.value = true;
}

// Save custom preferences
function saveCustomPreferences() {
    saveConsentPreferences(preferences.value);
    hideBanner();
    loadCookieScripts(preferences.value);
}

// Hide banner and modal
function hideBanner() {
    showBanner.value = false;
    showCustomizeModal.value = false;
}

// Save consent preferences
function saveConsentPreferences(prefs) {
    const consentData = {
        ...prefs,
        timestamp: new Date().toISOString(),
        version: '1.0'
    };
    
    localStorage.setItem('cookie_consent', JSON.stringify(consentData));
    
    // Send to backend for both authenticated and anonymous users
    const payload = {
        necessary_cookies: prefs.essential || true,
        analytics_cookies: prefs.performance || false,
        functional_cookies: prefs.functional || false,
        marketing_cookies: prefs.marketing || false
    };
    
    // Add session_id for anonymous users only
    // Authenticated users are identified via session/auth middleware
    if (!props.user || !props.user.id) {
        payload.session_id = getOrCreateSessionId();
    }
    
    fetch('/legal/privacy/cookie-consent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        credentials: 'include',
        body: JSON.stringify(payload)
    })
    .then(response => {
        if (!response.ok) {
            console.error('🍪 Consent save failed:', response.status, response.statusText);
            // Even if backend fails, consent is saved in localStorage
        }
        return response.json();
    })
    .then(data => {
        console.log('🍪 Consent saved:', data);
    })
    .catch(error => {
        console.error('🍪 Error saving consent:', error);
        // Consent is still saved in localStorage, so user experience is not affected
    });
}

// Load cookie scripts based on preferences
function loadCookieScripts(prefs) {
    if (prefs.performance && !window.gtag) {
        loadGoogleAnalytics();
    }
    
    if (prefs.marketing) {
        loadMarketingScripts();
    }
    
    if (prefs.functional) {
        loadFunctionalScripts();
    }
}

// Remove non-essential cookies
function removeNonEssentialCookies() {
    const cookiesToRemove = ['_ga', '_ga_', '_gid', '_gat', '_fbp', '_fbc', 'fr'];
    cookiesToRemove.forEach(cookie => {
        document.cookie = `${cookie}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    });
}

// Load Google Analytics
function loadGoogleAnalytics() {
    if (window.gtag) return;
    
    // Get the CSP nonce from meta tag
    const nonceMeta = document.querySelector('meta[name="csp-nonce"]');
    const nonce = nonceMeta?.content || '';
    
    const script1 = document.createElement('script');
    script1.async = true;
    script1.src = 'https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID';
    if (nonce) script1.setAttribute('nonce', nonce);
    document.head.appendChild(script1);
    
    const script2 = document.createElement('script');
    if (nonce) script2.setAttribute('nonce', nonce);
    script2.innerHTML = `
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    `;
    document.head.appendChild(script2);
}

// Load marketing scripts
function loadMarketingScripts() {

}

// Load functional scripts
function loadFunctionalScripts() {

}
</script> 