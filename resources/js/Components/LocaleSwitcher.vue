<script setup>
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const page = usePage()
const { locale } = useI18n()

function changeLocale(newLocale) {
  router.post(route('locale.change', newLocale), {}, {
    preserveScroll: true,
    onSuccess: () => {
        window.location.reload();
        locale.value = newLocale
        page.props.locale = newLocale
    }
  })
}
</script>

<template>
    <div class="d-flex align-items-center">
        <div class="dropdown ms-auto">
            <button
                class="btn text-white dropdown-toggle border-0 bg-transparent d-block d-md-inline-block"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                🌐 {{ $i18n.locale.toUpperCase() }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                <a class="dropdown-item" href="#" @click.prevent="changeLocale('en')">EN</a>
                </li>
                <li>
                <a class="dropdown-item" href="#" @click.prevent="changeLocale('pt')">PT</a>
                </li>
            </ul>
        </div>
    </div>
</template>
