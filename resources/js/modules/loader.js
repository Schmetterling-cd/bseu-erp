import { useLoading } from 'vue-loading-overlay';

const loading = useLoading();

export default {
    loader: null,
    activeRequests: [],

    showLoader(requestName) {
        this.activeRequests.push(requestName);

        if (this.loader === null) {
            this.loader = loading.show({
                color: '#084484ff',
                height: 64,
                width: 64,
                canCancel: false,
                backgroundColor: '#484848ff',
                opacity: 0.7
            });
        }
    },

    hideLoader(requestName) {
        this.activeRequests = this.activeRequests.filter(request => request !== requestName);

        if (this.activeRequests.length === 0 && this.loader !== null) {
            this.loader.hide();
            this.loader = null;
        }
    },
}
