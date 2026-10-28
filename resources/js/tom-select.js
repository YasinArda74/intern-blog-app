import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

window.initTomSelect = function (selector, options = {}) {
    const el = document.querySelector(selector);
    if (!el) return null;          // eleman yoksa hata verme
    if (el.tomselect) return el.tomselect;  // zaten başlatılmışsa tekrar başlatma

    return new TomSelect(el, {
        sortField: { field: 'text', direction: 'asc' },  // varsayılan ayar
        ...options                                        // dışarıdan gelenler üstüne yazar
    });
};
