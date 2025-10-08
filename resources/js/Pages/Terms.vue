<script setup>

</script>

<template>
    <Head>
        <title>{{ $t('page_title') }}</title>
        <meta name="description" :content="$t('page_description')" />
        <meta name="keywords" :content="$t('page_keywords')" />
        <meta property="og:title" :content="$t('og_title')" />
        <meta property="og:description" :content="$t('og_description')" />
        <meta property="og:url" content="https://hextechplay.com/terms" />
        <link rel="canonical" href="https://hextechplay.com/terms" />
    </Head>

    <div class="container p-4 rounded shadow-sm">
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center pt-5">
            <h2 class="mt-5 mb-3 display-3 fw-bold">{{ $t('title') }}</h2>
            <p class="text-muted mb-4">{{ $t('last_updated') }}</p>

            <div class="mt-5">
            <section v-for="n in 7" :key="n" class="mb-3">
                <h5>{{ $t(`section${n}_heading`) }}</h5>
                <p>{{ $t(`section${n}_content`) }}</p>
            </section>

            <h5>{{ $t('contact_heading') }}</h5>
            <p>{{ $t('contact_content') }}</p>
            </div>
        </div>
    </div>
</template>
