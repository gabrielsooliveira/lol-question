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
        locale.value = newLocale  // troca no front
        page.props.locale = newLocale // props do Inertia
    }
  })
}
</script>

<template>
  <div class="dropdown">
    <button class="btn btn-outline-white text-white dropdown-toggle border-0" data-bs-toggle="dropdown">
      🌐 {{ $i18n.locale.toUpperCase() }}
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="#" @click.prevent="changeLocale('en')">EN</a></li>
      <li><a class="dropdown-item" href="#" @click.prevent="changeLocale('pt_BR')">PT</a></li>
    </ul>
  </div>
</template>
