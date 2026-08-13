import { createI18n } from 'vue-i18n';
import axios from 'axios';

async function loadLocaleMessages(locale) {
    try {
        const response = await axios.get(`/translations/${locale}`);
        return response.data;
    } catch (error) {
        return {};
    }
}

const i18n = createI18n({
    locale: 'ru',
    fallbackLocale: 'en',
    legacy: false,
    globalInjection: true,
    messages: {},
});

export async function setLocale(locale) {
    const messages = await loadLocaleMessages(locale);

    i18n.global.setLocaleMessage(locale, messages);
    i18n.locale = locale;

    localStorage.setItem('locale', locale);
    axios.defaults.headers.common['Accept-Language'] = locale;
}

export async function initI18n() {
    let locale = localStorage.getItem('locale');

    if (!locale) {
        const browserLang = navigator.language.split('-')[0];
        const supportedLocales = ['ru', 'en', 'uk'];
        locale = supportedLocales.includes(browserLang) ? browserLang : 'ru';
    }

    await setLocale(locale);
    return i18n;
}

export default i18n;
