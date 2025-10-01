<!-- PopUpTerms.vue -->
<script setup>
import { ref, onMounted } from 'vue';

const checked = ref(false);
const showPopup = ref(false);

onMounted(() => {
  const accepted = localStorage.getItem('accepted_terms');
  if (accepted !== 'true') {
    showPopup.value = true;
  }
});

function acceptTerms() {
  localStorage.setItem('accepted_terms', 'true');
  showPopup.value = false;
}
</script>

<template>
    <div v-if="showPopup" class="w-100 py-2 px-3 position-fixed bg-dark z-3 bottom-0 end-0 shadow-sm border-top">
        <h2 class="mb-0 fs-5">Terms of Use and Service</h2>
        <p class="text-muted">Last updated: 2025-10-01</p>

        <div class="mb-1 overflow-y-auto" style="max-height: 100px;">
            <h4>1. Acceptance of Terms</h4>
            <p>By browsing and using the HextechPlay website, you automatically agree to our rules and conditions. These terms may change periodically, and by continuing to use the site, you accept the changes.</p>

            <h4>2. How to Use Our Website</h4>
            <p>Most of the site is accessible without registration, but some areas require an account. You are responsible for providing true information, keeping your login secure, and using resources respectfully and legally.</p>

            <h4>3. Your Privacy</h4>
            <p>By using the site, you accept our Privacy Policy, which describes how we collect, use, and protect your personal data with transparency and security.</p>

            <h4>4. Content Rights</h4>
            <p>All HextechPlay content (texts, images, videos, code, audio, etc.) is protected by copyright and intellectual property laws. Use is permitted only for personal and non-commercial purposes. Reproduction or distribution without authorization is prohibited.</p>

            <h4>5. Cookies and Technologies</h4>
            <p>We use cookies to improve your experience. You can limit or block cookies in your browser, but some features may not work properly.</p>

            <h4>6. External Links</h4>
            <p>Our site may include external links, but we are not responsible for third-party content or privacy practices.</p>

            <h4>7. Changes and Updates</h4>
            <p>We may update these Terms of Use periodically. By continuing to use our services after updates, you confirm acceptance of the new terms.</p>

            <h4>Questions or Comments?</h4>
            <p>Contact us by email: <a href="mailto:gabrielcodercontato@gmail.com">gabrielcodercontato@gmail.com</a></p>
        </div>

        <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-between align-items-md-center">
            <div class="form-check mb-3 mb-md-0">
                <input
                type="checkbox"
                class="form-check-input"
                id="acceptTerms"
                v-model="checked"
                >
                <label class="form-check-label" for="acceptTerms">
                I have read and accept the Terms of Use
                </label>
            </div>

            <!-- Botão -->
            <button
                class="btn btn-warning btn-sm fw-semibold"
                :disabled="!checked"
                @click="acceptTerms"
            >
                Accept
            </button>
        </div>
    </div>
</template>
