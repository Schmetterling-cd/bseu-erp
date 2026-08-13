import { ref, onMounted, onUnmounted, nextTick } from 'vue'

export function useScrollShadow() {
    const scrollContainer = ref(null)
    const showTopShadow = ref(false)
    const showBottomShadow = ref(false)

    const checkScroll = () => {
        if (!scrollContainer.value) return

        const el = scrollContainer.value
        const scrollTop = el.scrollTop
        const scrollHeight = el.scrollHeight
        const clientHeight = el.clientHeight

        showTopShadow.value = scrollTop > 0
        showBottomShadow.value = scrollTop + clientHeight < scrollHeight - 1
    }

    const updateScroll = () => {
        nextTick(() => {
            checkScroll()
        })
    }

    const handleScroll = () => {
        checkScroll()
    }

    onMounted(() => {
        if (scrollContainer.value) {
            scrollContainer.value.addEventListener('scroll', handleScroll)
            checkScroll()
        }
    })

    onUnmounted(() => {
        if (scrollContainer.value) {
            scrollContainer.value.removeEventListener('scroll', handleScroll)
        }
    })

    return {
        scrollContainer,
        showTopShadow,
        showBottomShadow,
        updateScroll
    }
}
