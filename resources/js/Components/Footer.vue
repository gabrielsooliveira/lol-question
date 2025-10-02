<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <footer class="bg-glass border-glow mt-3 border-top">
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-10 mb-4 text-lg-start text-center">
          <div class="d-flex align-items-center mb-3">
            <span class="fw-bold fs-4">HextechPlay</span>
          </div>
          <p class="opacity-75 mb-3">
            A plataforma definitiva de mini-games inspirada no universo de League of Legends. Teste suas habilidades e conhecimento sobre Runeterra.
          </p>
          <div class="d-flex justify-content-lg-start justify-content-center">
            <a href="#" class="btn btn-outline-light btn-sm me-2 disabled"><font-awesome-icon icon="fab fa-discord" /></a>
            <a href="#" class="btn btn-outline-light btn-sm me-2 disabled"><font-awesome-icon icon="fab fa-twitter" /></a>
            <a href="#" class="btn btn-outline-light btn-sm me-2 disabled"><font-awesome-icon icon="fab fa-youtube" /></a>
            <a href="https://www.facebook.com/people/HextechPlay/61581496198338/" target="_blank" class="btn btn-outline-light btn-sm"><font-awesome-icon icon="fab fa-facebook" /></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 mb-4">
          <h6 class="text-warning text-uppercase fw-semibold mb-3">Jogos</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><Link :href="route('lorequestion.index')" class="text-light text-decoration-none">LoreQuestion</Link></li>
            <li class="mb-2"><Link :href="route('runeterra.game')" class="text-light text-decoration-none">RuneterraGuess</Link></li>
          </ul>
        </div>

        <!-- Community -->
        <!-- <div class="col-lg-2 col-md-6 mb-4">
          <h6 class="text-warning text-uppercase fw-semibold mb-3">Comunidade</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Leaderboard</Link></li>
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Conquistas</Link></li>
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Torneios</Link></li>
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Fórum</Link></li>
          </ul>
        </div> -->

        <!-- Support -->
        <!-- <div class="col-lg-2 col-md-6 mb-4">
          <h6 class="text-warning text-uppercase fw-semibold mb-3">Suporte</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Central de Ajuda</Link></li>
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Contato</Link></li>
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Reportar Bug</Link></li>
            <li class="mb-2"><Link href="#" class="text-light text-decoration-none">Feedback</Link></li>
          </ul>
        </div> -->

        <!-- Newsletter -->
        <!-- <div class="col-lg-2 col-md-6 mb-4">
          <h6 class="text-warning text-uppercase fw-semibold mb-3">Newsletter</h6>
          <p class="opacity-75 small mb-3">
            Receba novidades sobre novos jogos e eventos.
          </p>
          <form class="d-flex">
            <input type="email" class="form-control form-control-sm me-2 bg-dark text-light border border-primary" placeholder="Seu e-mail">
            <button class="btn btn-warning btn-sm"><font-awesome-icon icon="fas fa-paper-plane" /></button>
          </form>
        </div> -->
      </div>

      <hr class="border-secondary my-4">

      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <small class="opacity-75">© 2025 HextechPlay</small>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <Link :href="route('privacy.policy')" class="text-light text-decoration-none me-3 small">Política de Privacidade</Link>
          <Link :href="route('terms')" class="text-light text-decoration-none small">Termos de Uso</Link>
        </div>
      </div>

    </div>
  </footer>
</template>

<style scoped>
.bg-glass {
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}
.border-glow {
  border-color: rgba(59, 130, 246, 0.3) !important;
}
</style>
