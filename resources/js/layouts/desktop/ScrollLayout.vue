<template>
    <div class="scroll-wrapper position-relative" style="max-height: inherit;">
        <div
            v-if="showTopShadow"
            class="scroll-shadow-top position-absolute top-0 start-0 end-0"
            style="pointer-events: none;"
        />

        <div
            ref="scrollContainer"
            class="grow overflow-auto system-scrollbar"
            style="max-height: inherit;"
        >
            <ul class="list-unstyled ps-0 mb-0">
                <slot></slot>
            </ul>
        </div>

        <div
            v-if="showBottomShadow"
            class="scroll-shadow-bottom position-absolute bottom-0 start-0 end-0 d-flex align-items-end justify-content-center"
            style="pointer-events: none; padding-bottom: 8px;"
        >
            <i
                class="bi bi-chevron-compact-down scroll-arrow main-system-color"
                style="pointer-events: auto; cursor: pointer; font-size: 28px;"
            ></i>
        </div>
    </div>
</template>

<script setup>
import { useScrollShadow } from "../../modules/scrollShadow.js";

const { scrollContainer, showTopShadow, showBottomShadow } = useScrollShadow();
</script>

<style scoped>
.scroll-wrapper {
    width: 100%;
    height: 100%;
}

.scroll-shadow-top {
    height: 30px;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9), transparent);
    z-index: 1;
    pointer-events: none;
}

.scroll-shadow-bottom {
    height: 50px;
    background: linear-gradient(to top, rgba(255, 255, 255, 0.9), transparent);
    z-index: 1;
    pointer-events: none;
}

.scroll-arrow {
    line-height: 1;
    transition: transform 0.2s ease;
    display: block;
}
</style>
