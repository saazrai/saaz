<template>
    <Head>
        <title>Privacy Settings | SecureStart™</title>
        <meta name="description" content="Manage your privacy preferences and data settings for SecureStart™." />
    </Head>

    <div :class="['transition-colors duration-300', isDark ? 'bg-gray-900' : 'bg-gray-50']">
        <!-- Hero Section -->
        <div :class="[
            'py-12 transition-colors duration-300',
            isDark 
                ? 'bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800' 
                : 'bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700'
        ]">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h1 :class="[
                    'text-4xl md:text-5xl font-bold mb-4 transition-colors duration-300',
                    isDark ? 'text-white' : 'text-white'
                ]">Privacy Settings</h1>
                <p :class="[
                    'text-xl transition-colors duration-300',
                    isDark ? 'text-gray-300' : 'text-blue-100'
                ]">
                    Manage your privacy preferences and consent settings
                </p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-4xl mx-auto px-6 py-12">
            <!-- Privacy Preferences -->
            <div :class="[
                'rounded-xl p-8 shadow-lg mb-8',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <h2 :class="['text-2xl font-bold mb-6', isDark ? 'text-white' : 'text-gray-900']">
                    Privacy Preferences
                </h2>

                <form @submit.prevent="updatePrivacySettings" class="space-y-6">
                    <!-- Marketing Consent -->
                    <div class="flex items-start space-x-4">
                        <div class="flex items-center h-5">
                            <input
                                id="marketing_consent"
                                v-model="form.marketing_consent"
                                type="checkbox"
                                :class="[
                                    'w-4 h-4 border-2 rounded focus:ring-2 focus:ring-blue-500',
                                    isDark 
                                        ? 'bg-gray-700 border-gray-600 text-blue-600' 
                                        : 'bg-white border-gray-300 text-blue-600'
                                ]"
                            />
                        </div>
                        <div class="ml-3">
                            <label for="marketing_consent" :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                                Marketing Communications
                            </label>
                            <p :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                                Receive updates about new features, security insights, and educational content.
                            </p>
                        </div>
                    </div>

                    <!-- Analytics Consent -->
                    <div class="flex items-start space-x-4">
                        <div class="flex items-center h-5">
                            <input
                                id="analytics_consent"
                                v-model="form.analytics_consent"
                                type="checkbox"
                                :class="[
                                    'w-4 h-4 border-2 rounded focus:ring-2 focus:ring-blue-500',
                                    isDark 
                                        ? 'bg-gray-700 border-gray-600 text-blue-600' 
                                        : 'bg-white border-gray-300 text-blue-600'
                                ]"
                            />
                        </div>
                        <div class="ml-3">
                            <label for="analytics_consent" :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                                Analytics & Performance
                            </label>
                            <p :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                                Help us improve the platform by sharing anonymous usage data and performance metrics.
                            </p>
                        </div>
                    </div>

                    <!-- Third Party Consent -->
                    <div class="flex items-start space-x-4">
                        <div class="flex items-center h-5">
                            <input
                                id="third_party_consent"
                                v-model="form.third_party_consent"
                                type="checkbox"
                                :class="[
                                    'w-4 h-4 border-2 rounded focus:ring-2 focus:ring-blue-500',
                                    isDark 
                                        ? 'bg-gray-700 border-gray-600 text-blue-600' 
                                        : 'bg-white border-gray-300 text-blue-600'
                                ]"
                            />
                        </div>
                        <div class="ml-3">
                            <label for="third_party_consent" :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                                Third-Party Integrations
                            </label>
                            <p :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                                Allow integration with third-party services for enhanced functionality and social features.
                            </p>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            :class="[
                                'px-6 py-3 rounded-lg font-medium transition-colors duration-200',
                                'bg-blue-600 hover:bg-blue-700 text-white',
                                'disabled:opacity-50 disabled:cursor-not-allowed',
                                'focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
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
                'rounded-xl p-8 shadow-lg mb-8',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <h2 :class="['text-2xl font-bold mb-6', isDark ? 'text-white' : 'text-gray-900']">
                    Data Management
                </h2>

                <div class="space-y-6">
                    <!-- Data Export -->
                    <div class="flex items-center justify-between p-4 border rounded-lg" 
                         :class="isDark ? 'border-gray-600 bg-gray-700' : 'border-gray-200 bg-gray-50'">
                        <div>
                            <h3 :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                                Export Your Data
                            </h3>
                            <p :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                                Download a copy of all your personal data and assessment results.
                            </p>
                        </div>
                        <button
                            @click="exportData"
                            :disabled="exportProcessing"
                            :class="[
                                'px-4 py-2 rounded-lg font-medium transition-colors duration-200',
                                'bg-green-600 hover:bg-green-700 text-white',
                                'disabled:opacity-50 disabled:cursor-not-allowed'
                            ]"
                        >
                            <span v-if="exportProcessing">Exporting...</span>
                            <span v-else>Export Data</span>
                        </button>
                    </div>

                    <!-- Data Deletion -->
                    <div class="flex items-center justify-between p-4 border rounded-lg"
                         :class="isDark ? 'border-red-600 bg-red-900/20' : 'border-red-200 bg-red-50'">
                        <div>
                            <h3 :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                                Delete Account
                            </h3>
                            <p :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                                Permanently delete your account and all associated data.
                            </p>
                        </div>
                        <button
                            @click="showDeleteConfirmation = true"
                            :class="[
                                'px-4 py-2 rounded-lg font-medium transition-colors duration-200',
                                'bg-red-600 hover:bg-red-700 text-white'
                            ]"
                        >
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>

            <!-- Consent History -->
            <div v-if="consents && consents.length > 0" :class="[
                'rounded-xl p-8 shadow-lg',
                isDark ? 'bg-gray-800' : 'bg-white'
            ]">
                <h2 :class="['text-2xl font-bold mb-6', isDark ? 'text-white' : 'text-gray-900']">
                    Consent History
                </h2>

                <div class="space-y-4">
                    <div v-for="consent in consents" :key="consent.id"
                         :class="[
                             'p-4 border rounded-lg',
                             isDark ? 'border-gray-600 bg-gray-700' : 'border-gray-200 bg-gray-50'
                         ]">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 :class="['font-medium', isDark ? 'text-white' : 'text-gray-900']">
                                    {{ consent.regulation }} - Version {{ consent.consent_version }}
                                </h3>
                                <p :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                                    Consent given: {{ formatDate(consent.consent_given_at) }}
                                </p>
                            </div>
                            <span :class="[
                                'px-2 py-1 text-xs rounded-full',
                                consent.is_consent_given
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-red-100 text-red-800'
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
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div :class="[
            'max-w-md mx-4 p-6 rounded-lg shadow-lg',
            isDark ? 'bg-gray-800' : 'bg-white'
        ]">
            <h3 :class="['text-lg font-bold mb-4', isDark ? 'text-white' : 'text-gray-900']">
                Confirm Account Deletion
            </h3>
            <p :class="['mb-6', isDark ? 'text-gray-300' : 'text-gray-600']">
                This action cannot be undone. All your data will be permanently deleted.
            </p>
            <div class="flex justify-end space-x-4">
                <button
                    @click="showDeleteConfirmation = false"
                    :class="[
                        'px-4 py-2 rounded-lg font-medium',
                        isDark 
                            ? 'bg-gray-600 hover:bg-gray-700 text-white' 
                            : 'bg-gray-200 hover:bg-gray-300 text-gray-800'
                    ]"
                >
                    Cancel
                </button>
                <button
                    @click="deleteAccount"
                    :disabled="deleteProcessing"
                    class="px-4 py-2 rounded-lg font-medium bg-red-600 hover:bg-red-700 text-white disabled:opacity-50"
                >
                    <span v-if="deleteProcessing">Deleting...</span>
                    <span v-else>Delete Account</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, inject } from 'vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

defineOptions({
    layout: AppLayout,
});

// Get dark mode state from AppLayout (via provide/inject)
const isDark = inject('isDark', false)
const page = usePage()

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

