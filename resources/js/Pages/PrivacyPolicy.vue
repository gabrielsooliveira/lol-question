<script setup>
import { Head } from "@inertiajs/vue3";

const props = defineProps(["translations"]);
</script>

<template>
    <Head>
        <title>{{ props.translations.page_title }}</title>
        <meta head-key="description" name="description" :content="props.translations.page_description" />
    </Head>

    <div class="d-flex justify-content-center align-items-center py-5 min-vh-100 text-white">
        <div class="container">
            <h1 class="h3 fw-bold mb-4">Privacy Policy for HextechPlay</h1>
        <p class="text-warning small mb-4">
            <strong>Effective Date:</strong>
            {{ new Date().toISOString().split("T")[0] }}
        </p>

        <p>
            At <strong>HextechPlay</strong>, we respect your privacy and are
            committed to protecting the personal information of our visitors.
            This Privacy Policy explains how we handle information when you use
            our website.
        </p>

        <h2 class="h5 fw-semibold mt-4">Information We Collect</h2>
        <p>
            We do not directly collect personally identifiable information
            unless voluntarily provided...
        </p>

        <h2 class="h5 fw-semibold mt-4">Cookies and Google Advertising</h2>
        <p>
            HextechPlay uses third-party vendors, including Google, that utilize
            cookies to serve ads. Google uses the
            <strong>DART cookie</strong> to serve ads based on visits to this
            site and others. Users may opt out via
            <a
                href="https://www.google.com/settings/ads"
                target="_blank"
                class="link-warning"
                >Google Ads Settings</a
            >.
        </p>

        <h2 class="h5 fw-semibold mt-4">Third-Party Links</h2>
        <p>
            Our website may contain links to external websites. We are not
            responsible for their practices.
        </p>

        <h2 class="h5 fw-semibold mt-4">Consent</h2>
        <p>By using HextechPlay, you consent to this Privacy Policy.</p>

        <h2 class="h5 fw-semibold mt-4">Contact Us</h2>
        <p>
            If you have questions, contact us at:
            <a href="mailto:contact@hextechplay.com" class="link-warning"
                >contact@hextechplay.com</a
            >
        </p>
        </div>
    </div>
</template>
