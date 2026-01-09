<template>
  <div class="input-group">
    <input
      type="text"
      class="form-control"
      :placeholder="placeholder"
      v-model="query"
      @keyup.enter="$emit('search', query)"
    >
    <button
      class="btn btn-outline-secondary"
      type="button"
      @click="$emit('search', query)"
      :disabled="!query.trim()"
    >
      <i class="bi bi-search"></i>
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  placeholder: {
    type: String,
    default: 'Поиск...'
  }
});

const emit = defineEmits(['search']);
const query = ref('');
</script>
