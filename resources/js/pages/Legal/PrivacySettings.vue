<template>
    <Head>
        <title>Privacy Settings | SecureStart™</title>
        <meta name="description" content="Manage your privacy preferences and data settings for SecureStart™." />
    </Head>

    <div :class="['transition-colors duration-300', isDark ? 'bg-gray-900' : 'bg-gray-50']">
        <!-- Hero Section - Apple Style -->
        <div :class="[
            'py-16 mx-6 mt-6 rounded-3xl transition-all duration-300 relative overflow-hidden',
            isDark 
                ? 'bg-gradient-to-br from-gray-800 via-slate-700 to-gray-800' 
                : 'bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700'
        ]">
            <!-- Glassmorphism overlay -->
            <div class="absolute inset-0 bg-white/10 backdrop-blur-xl"></div>
            
            <div class="relative max-w-4xl mx-auto px-8 text-center">
                <h1 :class="[
                    'text-4xl md:text-5xl font-bold mb-4 transition-colors duration-300',
                    'tracking-tight leading-tight',
                    'text-white drop-shadow-lg'
                ]">Privacy Settings</h1>
                <p :class="[
                    'text-xl md:text-2xl transition-colors duration-300 max-w-2xl mx-auto',
                    'text-white/90 drop-shadow-md font-medium'
                ]">
                    Manage your privacy preferences and consent settings
                </p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-4xl mx-auto px-6 py-12">
            <!-- Privacy Preferences -->
            <div :class="[
                'rounded-3xl p-8 mb-8 border backdrop-blur-xl transition-all duration-300 hover:shadow-2xl',
                isDark 
                    ? 'bg-gray-800/50 border-gray-700/50 shadow-2xl' 
                    : 'bg-white/80 border-gray-200/30 shadow-xl'
            ]">
                <h2 :class="[
                    'text-3xl font-bold mb-8 tracking-tight',
                    isDark ? 'text-white' : 'text-gray-900'
                ]">
                    Privacy Preferences
                </h2>

                <form @submit.prevent="updatePrivacySettings" class="space-y-8">
                    <!-- Marketing Consent -->
                    <div :class="[
                        'flex items-start space-x-6 p-6 rounded-2xl border transition-all duration-300',
                        isDark 
                            ? 'bg-gray-700/30 border-gray-600/50 hover:bg-gray-700/50' 
                            : 'bg-gray-50/80 border-gray-200/50 hover:bg-gray-100/80'
                    ]">
                        <div class="flex items-center h-6 mt-1">
                            <input
                                id="marketing_consent"
                                v-model="form.marketing_consent"
                                type="checkbox"
                                :class="[
                                    'w-5 h-5 border-2 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200',
                                    isDark 
                                        ? 'bg-gray-600 border-gray-500 text-blue-500 focus:bg-gray-500' 
                                        : 'bg-white border-gray-300 text-blue-600 focus:bg-blue-50'
                                ]"
                            />
                        </div>
                        <div class="flex-1">
                            <label for="marketing_consent" :class="[
                                'text-lg font-semibold block cursor-pointer',
                                isDark ? 'text-white' : 'text-gray-900'
                            ]">
                                Marketing Communications
                            </label>
                            <p :class="[
                                'text-sm mt-2 leading-relaxed',
                                isDark ? 'text-gray-300' : 'text-gray-600'
                            ]">
                                Receive updates about new features, security insights, and educational content.
                            </p>
                        </div>
                    </div>

                    <!-- Analytics Consent -->
                    <div :class="[
                        'flex items-start space-x-6 p-6 rounded-2xl border transition-all duration-300',
                        isDark 
                            ? 'bg-gray-700/30 border-gray-600/50 hover:bg-gray-700/50' 
                            : 'bg-gray-50/80 border-gray-200/50 hover:bg-gray-100/80'
                    ]">
                        <div class="flex items-center h-6 mt-1">
                            <input
                                id="analytics_consent"
                                v-model="form.analytics_consent"
                                type="checkbox"
                                :class="[
                                    'w-5 h-5 border-2 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200',
                                    isDark 
                                        ? 'bg-gray-600 border-gray-500 text-blue-500 focus:bg-gray-500' 
                                        : 'bg-white border-gray-300 text-blue-600 focus:bg-blue-50'
                                ]"
                            />
                        </div>
                        <div class="flex-1">
                            <label for="analytics_consent" :class="[
                                'text-lg font-semibold block cursor-pointer',
                                isDark ? 'text-white' : 'text-gray-900'
                            ]">
                                Analytics & Performance
                            </label>
                            <p :class="[
                                'text-sm mt-2 leading-relaxed',
                                isDark ? 'text-gray-300' : 'text-gray-600'
                            ]">
                                Help us improve the platform by sharing anonymous usage data and performance metrics.
                            </p>
                        </div>
                    </div>

                    <!-- Third Party Consent -->
                    <div :class="[
                        'flex items-start space-x-6 p-6 rounded-2xl border transition-all duration-300',
                        isDark 
                            ? 'bg-gray-700/30 border-gray-600/50 hover:bg-gray-700/50' 
                            : 'bg-gray-50/80 border-gray-200/50 hover:bg-gray-100/80'
                    ]">
                        <div class="flex items-center h-6 mt-1">
                            <input
                                id="third_party_consent"
                                v-model="form.third_party_consent"
                                type="checkbox"
                                :class="[
                                    'w-5 h-5 border-2 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-200',
                                    isDark 
                                        ? 'bg-gray-600 border-gray-500 text-blue-500 focus:bg-gray-500' 
                                        : 'bg-white border-gray-300 text-blue-600 focus:bg-blue-50'
                                ]"
                            />
                        </div>
                        <div class="flex-1">
                            <label for="third_party_consent" :class="[
                                'text-lg font-semibold block cursor-pointer',
                                isDark ? 'text-white' : 'text-gray-900'
                            ]">
                                Third-Party Integrations
                            </label>
                            <p :class="[
                                'text-sm mt-2 leading-relaxed',
                                isDark ? 'text-gray-300' : 'text-gray-600'
                            ]">
                                Allow integration with third-party services for enhanced functionality and social features.
                            </p>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="pt-6">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            :class="[
                                'px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-300',
                                'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800',
                                'text-white shadow-lg hover:shadow-xl',
                                'disabled:opacity-50 disabled:cursor-not-allowed',
                                'focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
                                'transform hover:scale-[1.02] active:scale-[0.98]'
                            ]"
                        >
                            <span v-if="form.processing">Saving...</span>
                            <span v-else>Save Preferences</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Data Management -->
            <div :class="[
                'rounded-3xl p-8 mb-8 border backdrop-blur-xl transition-all duration-300 hover:shadow-2xl',
                isDark 
                    ? 'bg-gray-800/50 border-gray-700/50 shadow-2xl' 
                    : 'bg-white/80 border-gray-200/30 shadow-xl'
            ]">
                <h2 :class="[
                    'text-3xl font-bold mb-8 tracking-tight',
                    isDark ? 'text-white' : 'text-gray-900'
                ]">
                    Data Management
                </h2>

                <div class="space-y-6">
                    <!-- Data Export -->
                    <div :class="[
                        'flex items-center justify-between p-6 border rounded-2xl transition-all duration-300',
                        isDark 
                            ? 'border-green-600/50 bg-green-900/20 hover:bg-green-900/30' 
                            : 'border-green-200/70 bg-green-50/80 hover:bg-green-100/80'
                    ]">
                        <div class="flex-1">
                            <h3 :class="[
                                'text-lg font-semibold mb-2',
                                isDark ? 'text-white' : 'text-gray-900'
                            ]">
                                Export Your Data
                            </h3>
                            <p :class="[
                                'text-sm leading-relaxed',
                                isDark ? 'text-gray-300' : 'text-gray-600'
                            ]">
                                Download a copy of all your personal data and assessment results.
                            </p>
                        </div>
                        <button
                            @click="exportData"
                            :disabled="exportProcessing"
                            :class="[
                                'ml-6 px-6 py-3 rounded-xl font-semibold transition-all duration-300',
                                'bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800',
                                'text-white shadow-lg hover:shadow-xl',
                                'disabled:opacity-50 disabled:cursor-not-allowed',
                                'transform hover:scale-[1.02] active:scale-[0.98]'
                            ]"
                        >
                            <span v-if="exportProcessing">Exporting...</span>
                            <span v-else>Export Data</span>
                        </button>
                    </div>

                    <!-- Data Deletion -->
                    <div :class="[
                        'flex items-center justify-between p-6 border rounded-2xl transition-all duration-300',
                        isDark 
                            ? 'border-red-600/50 bg-red-900/20 hover:bg-red-900/30' 
                            : 'border-red-200/70 bg-red-50/80 hover:bg-red-100/80'
                    ]">
                        <div class="flex-1">
                            <h3 :class="[
                                'text-lg font-semibold mb-2',
                                isDark ? 'text-white' : 'text-gray-900'
                            ]">
                                Delete Account
                            </h3>
                            <p :class="[
                                'text-sm leading-relaxed',
                                isDark ? 'text-gray-300' : 'text-gray-600'
                            ]">
                                Permanently delete your account and all associated data.
                            </p>
                        </div>
                        <button
                            @click="showDeleteConfirmation = true"
                            :class="[
                                'ml-6 px-6 py-3 rounded-xl font-semibold transition-all duration-300',
                                'bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800',
                                'text-white shadow-lg hover:shadow-xl',
                                'transform hover:scale-[1.02] active:scale-[0.98]'
                            ]"
                        >
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>

            <!-- Consent History -->
            <div v-if="consents && consents.length > 0" :class="[
                'rounded-3xl p-8 border backdrop-blur-xl transition-all duration-300 hover:shadow-2xl',
                isDark 
                    ? 'bg-gray-800/50 border-gray-700/50 shadow-2xl' 
                    : 'bg-white/80 border-gray-200/30 shadow-xl'
            ]">
                <h2 :class="[
                    'text-3xl font-bold mb-8 tracking-tight',
                    isDark ? 'text-white' : 'text-gray-900'
                ]">
                    Consent History
                </h2>

                <div class="space-y-4">
                    <div v-for="consent in consents" :key="consent.id"
                         :class="[
                             'p-6 border rounded-2xl transition-all duration-300',
                             isDark 
                                ? 'border-gray-600/50 bg-gray-700/30 hover:bg-gray-700/50' 
                                : 'border-gray-200/50 bg-gray-50/80 hover:bg-gray-100/80'
                         ]">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 :class="[
                                    'text-lg font-semibold mb-2',
                                    isDark ? 'text-white' : 'text-gray-900'
                                ]">
                                    {{ consent.regulation }} - Version {{ consent.consent_version }}
                                </h3>
                                <p :class="[
                                    'text-sm leading-relaxed',
                                    isDark ? 'text-gray-300' : 'text-gray-600'
                                ]">
                                    Consent given: {{ formatDate(consent.consent_given_at) }}
                                </p>
                            </div>
                            <span :class="[
                                'ml-4 px-3 py-1 text-sm font-medium rounded-full',
                                consent.is_consent_given
                                    ? isDark 
                                        ? 'bg-green-900/30 text-green-300 border border-green-600/50'
                                        : 'bg-green-100 text-green-800 border border-green-300'
                                    : isDark
                                        ? 'bg-red-900/30 text-red-300 border border-red-600/50'
                                        : 'bg-red-100 text-red-800 border border-red-300'
                            ]">
                                {{ consent.is_consent_given ? 'Active' : 'Withdrawn' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteConfirmation" 
         class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div :class="[
            'max-w-md w-full p-8 rounded-3xl border backdrop-blur-xl transition-all duration-300 shadow-2xl',
            isDark 
                ? 'bg-gray-800/90 border-gray-700/50' 
                : 'bg-white/90 border-gray-200/30'
        ]">
            <h3 :class="[
                'text-2xl font-bold mb-4 text-center',
                isDark ? 'text-white' : 'text-gray-900'
            ]">
                Confirm Account Deletion
            </h3>
            <p :class="[
                'mb-8 text-center leading-relaxed',
                isDark ? 'text-gray-300' : 'text-gray-600'
            ]">
                This action cannot be undone. All your data will be permanently deleted.
            </p>
            <div class="flex justify-center space-x-4">
                <button
                    @click="showDeleteConfirmation = false"
                    :class="[
                        'px-6 py-3 rounded-xl font-semibold transition-all duration-300',
                        'transform hover:scale-[1.02] active:scale-[0.98]',
                        isDark 
                            ? 'bg-gray-700 hover:bg-gray-600 text-white border border-gray-600' 
                            : 'bg-gray-100 hover:bg-gray-200 text-gray-800 border border-gray-300'
                    ]"
                >
                    Cancel
                </button>
                <button
                    @click="deleteAccount"
                    :disabled="deleteProcessing"
                    :class="[
                        'px-6 py-3 rounded-xl font-semibold transition-all duration-300',
                        'bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800',
                        'text-white shadow-lg hover:shadow-xl disabled:opacity-50',
                        'transform hover:scale-[1.02] active:scale-[0.98]'
                    ]"
                >
                    <span v-if="deleteProcessing">Deleting...</span>
                    <span v-else>Delete Account</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, inject } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

defineOptions({
    layout: AppLayout,
});

// Get dark mode state from AppLayout (via provide/inject)
const isDark = inject('isDark', false)

// Props
const props = defineProps({
    privacySettings: Object,
    consents: Array,
    dataCategories: Array
})

// Form for privacy settings
const form = useForm({
    marketing_consent: false,
    analytics_consent: false,
    third_party_consent: false
})

// State
const exportProcessing = ref(false)
const deleteProcessing = ref(false)
const showDeleteConfirmation = ref(false)

// Initialize form with existing settings
onMounted(() => {
    if (props.privacySettings) {
        form.marketing_consent = props.privacySettings.marketing_consent || false
        form.analytics_consent = props.privacySettings.analytics_consent || false
        form.third_party_consent = props.privacySettings.third_party_consent || false
    }
})

// Methods
const updatePrivacySettings = () => {
    form.post(route('privacy.settings.update'), {
        preserveScroll: true,
        onSuccess: () => {
            // Handle success (maybe show a toast notification)
        }
    })
}

const exportData = async () => {
    exportProcessing.value = true
    try {
        window.location.href = route('privacy.export')
    } catch (error) {
        console.error('Export failed:', error)
    } finally {
        exportProcessing.value = false
    }
}

const deleteAccount = () => {
    deleteProcessing.value = true
    form.delete(route('privacy.delete'), {
        onFinish: () => {
            deleteProcessing.value = false
            showDeleteConfirmation.value = false
        }
    })
}

const formatDate = (dateString) => {
    if (!dateString) return 'N/A'
    return new Date(dateString).toLocaleDateString()
}
</script>

