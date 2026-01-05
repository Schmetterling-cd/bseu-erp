<template>
    <div class="navbar navbar-light bg-white border-bottom border-bseu-bold h-55-px mx-0 my-0 px-0 py-0">
        <div class="container-fluid align-items-start mx-0 my-0 px-0 py-0 h-100">
            <IconButton class="border-end border-secondary" size="55px" @click="emitToggle">
                <i v-if="!isCollapsed" class="bi bi-arrow-bar-left fs-4 d-block w-100 h-100 d-flex align-items-center justify-content-center"></i>
                <i v-else class="bi bi-arrow-bar-right fs-4 d-block w-100 h-100 d-flex align-items-center justify-content-center"></i>
            </IconButton>

            <div class="d-flex flex-row h-100">
                <IconButton class="border-start border-secondary" size="55px">
                    <i class="bi bi-person-fill fs-4 d-block w-100 h-100 d-flex align-items-center justify-content-center"></i>
                </IconButton>

                <IconButton class="border-start border-secondary" size="55px">
                    <i class="bi bi-box-arrow-right fs-4 d-block w-100 h-100 d-flex align-items-center justify-content-center"></i>
                </IconButton>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits  } from 'vue';
import IconButton from './IconButton.vue';

const props = defineProps({
    isCollapsed: {
        type: Boolean,
        required: true
    },
});

const emit = defineEmits(['toggle']);

const emitToggle = () => {
    emit('toggle');
};
</script>

<style scoped></style>
