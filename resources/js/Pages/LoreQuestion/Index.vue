<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container text-center">
      <!-- Título -->
      <h1 class="fw-bold mb-5 text-light">Escolha o modo de jogo</h1>

      <!-- Cards de modos -->
      <div class="row g-4 justify-content-center">
        <!-- Roleplay -->
        <div class="col-md-4">
          <div class="card h-100 shadow-lg border-0">
            <div class="card-body d-flex flex-column justify-content-between bg-gradient text-dark">
              <div>
                <h4 class="card-title fw-bold">Roleplay</h4>
                <p class="card-text small">
                  Teste seus conhecimentos sobre as histórias de runeterra.
                </p>
              </div>
              <Link :href="route('lorequestion.roleplay')" class="btn btn-danger text-white mt-3">Jogar</Link>
            </div>
          </div>
        </div>

        <!-- Competitivo (desativado por enquanto) -->
        <div class="col-md-4">
          <div class="card h-100 shadow-lg border-0">
            <div class="card-body d-flex flex-column justify-content-between bg-gradient text-dark">
              <div>
                <h4 class="card-title fw-bold">Competitivo</h4>
                <p class="card-text small">
                  Teste seus conhecimentos contra outros jogadores. (Em breve)
                </p>
              </div>
              <button class="btn btn-dark mt-3" disabled>Em breve</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
