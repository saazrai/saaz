<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
  regulation: String,
  consentVersion: String,
  privacyPolicyUrl: String,
  termsUrl: String,
});

const form = useForm({
  regulation: props.regulation,
  consent_given: false,
});

const submit = () => {
  if (!form.consent_given) {
    form.setError('consent_given', 'You must agree to the Privacy Policy and Terms of Service.');
    return;
  }
  form.post(route('privacy.consent.store'));
};
</script>
<template>
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
      <h2 class="text-2xl font-bold text-center text-blue-900 mb-2">Consent Required</h2>
      <p class="text-center text-gray-600 mb-6 text-sm">
        To use SecureStart™, you must agree to our Privacy Policy and Terms of Service.
      </p>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="flex items-center">
            <input type="checkbox" v-model="form.consent_given" required />
            <span class="ml-2 text-sm text-gray-600">
              I agree to the
              <a :href="props.privacyPolicyUrl" target="_blank" class="text-blue-600 underline">Privacy Policy</a>
              and
              <a :href="props.termsUrl" target="_blank" class="text-blue-600 underline">Terms of Service</a>
              (v{{ props.consentVersion }})
            </span>
          </label>
          <div v-if="form.errors.consent_given" class="text-red-500 text-xs mt-2">{{ form.errors.consent_given }}</div>
        </div>
        <button type="submit" class="w-full bg-blue-900 text-white rounded-lg py-2 font-semibold hover:bg-blue-800 transition">
          Agree and Continue
        </button>
      </form>
    </div>
  </div>
</template>