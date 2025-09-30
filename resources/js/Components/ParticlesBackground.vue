<script setup>
import { ref, onMounted } from 'vue';

const particles = ref([]);

const initParticles = () => {
  particles.value = Array.from({ length: 50 }, (_, i) => ({
    id: i,
    x: Math.random() * 100,
    y: Math.random() * 100,
    size: Math.random() * 3 + 1,
    speed: Math.random() * 2 + 1,
    opacity: Math.random() * 0.5 + 0.2
  }));
};

onMounted(() => {
  initParticles();
});
</script>

<template>
  <div>
    <div class="particles-container">
      <div
        v-for="particle in particles"
        :key="particle.id"
        class="particle"
        :style="{
          left: particle.x + '%',
          top: particle.y + '%',
          width: particle.size + 'px',
          height: particle.size + 'px',
          opacity: particle.opacity,
          animationDuration: particle.speed + 's'
        }"
      ></div>
    </div>
    <div class="background-overlay"></div>
  </div>
</template>

<style lang="scss" scoped>
.particles-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 1;
}

.particle {
  position: absolute;
  background: rgba(59, 130, 246, 0.3);
  border-radius: 50%;
  animation: float linear infinite;
}

@keyframes float {
  0% { transform: translateY(100vh) rotate(0deg); }
  100% { transform: translateY(-100px) rotate(360deg); }
}

.background-overlay {
  position: fixed;
  inset: 0;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
  pointer-events: none;
  z-index: 2;
}
</style>
