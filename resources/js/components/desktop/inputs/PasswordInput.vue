<template>
    <div class="form-group">
        <label v-if="label">{{ label }}</label>
        <div class="input-wrapper" :class="{ 'has-error': props.isInvalid }">
            <Input
                :model-value="modelValue"
                @update:model-value="updatePassword"
                :type="showPassword ? 'text' : 'password'"
                :placeholder="placeholder"
                :name="name"
                :class="[{ 'is-invalid': props.isInvalid }]"
            />

            <div v-if="props.isInvalid" class="error-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#dc3545">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
            </div>

            <button
                type="button"
                class="password-toggle"
                @click="togglePasswordVisibility"
            >
                <svg :class="{ 'error': props.isInvalid }" class="eye-icon" width="20" height="20" viewBox="0 0 24 24">
                    <path v-if="showPassword" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    <path v-else d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Input from './Input.vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: ''
    },
    isInvalid: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:modelValue']);

const showPassword = ref(false);

const updatePassword = (value) => {
    emit('update:modelValue', value);
};

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
}
</script>

<style scoped>
.input-wrapper {
    position: relative;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
}

/* Стили для инпута */
.input-wrapper :deep(.form-control) {
    padding-right: 2.5rem; /* Базовый отступ для глаза */
}

/* Когда есть ошибка - увеличиваем отступ */
.input-wrapper.has-error :deep(.form-control) {
    padding-right: 4.5rem; /* Увеличиваем отступ чтобы вместить иконку ошибки */
    background-image: none !important; /* Убираем стандартную иконку Bootstrap */
}

/* Иконка ошибки - появляется слева от глазика */
.error-icon {
    position: absolute;
    right: 2.8rem; /* Ставим слева от кнопки глаза */
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none; /* Чтобы клики проходили сквозь */
    z-index: 2;
    animation: fadeIn 0.2s ease;
}

/* Кнопка глаза - всегда на одном месте */
.password-toggle {
    position: absolute;
    right: 0.5rem; /* Фиксированная позиция, не меняется */
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: background-color 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 3;
}

.eye-icon {
    fill: #718096;
    transition: fill 0.2s ease;
}

.password-toggle:hover .eye-icon {
    fill: var(--main-system-color, #4a5568);
}

.eye-icon.error path {
    fill: var(--bs-danger);
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>
