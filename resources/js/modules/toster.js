import { toast } from "vue3-toastify";

export default {
    show(message, type = 'info') {
        toast[type](message, {
            position: toast.POSITION.BOTTOM_CENTER,
        });
    }
};
