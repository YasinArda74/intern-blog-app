import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";
import "../css/tom-select.css";

window.TomSelect = TomSelect;

// Default tom select config
let defaultTomSelectConfig = {
    create: false,
    sortField: {
        field: "text",
        direction: "asc"
    }
};

/**
 * Verilen route üzerinde arar. Cevap [{value, text}, ...] olmalıdır.
 * Boş sorgu istek atmaz; bulunan kayıtlar mevcut seçeneklere eklenir.
 */
window.remoteSearchConfig = function (url) {
    return {
        valueField: "value",
        labelField: "text",
        searchField: ["text"],
        shouldLoad(query) {
            return query.length > 0;
        },
        load(query, callback) {
            window.axios.get(url, {
                params: { q: query },
            })
                .then((response) => {
                    const results = response.data;

                    callback(Array.isArray(results) ? results : []);
                })
                .catch(() => callback());
        },
    };
};

/**
 * inputEl: HTMLInputElement (#input, .input),
 * extraConfig: Object (initTomSelect çalıştırılırken parametre olark gönderilir)
 *
 * Eğer extraConfig boş ise defaultTomSelectConfig kullanılır
 */
window.initTomSelect = function (inputEl, searchUrl = null, extraConfig = {}) {
    // Seçilen inputu bulur
    const element = findSelectedField(inputEl);

    // Tom selectin config ayarları belirlenir
    let config = prepareTomSelectConfig(searchUrl, extraConfig);

    const instance = new TomSelect(element, config);

    // Set Style Flowbite
    setStyleFlowbite(element, instance);

    return instance;
}


// Helper functions
function findSelectedField(inputEl) {
    const element = typeof inputEl === "string" ? document.querySelector(inputEl) : inputEl;

    // Eğer input yoksa veya zaten TomSelect instance'ı varsa, null döndürür
    if (!element || element.tomselect) {
        return element?.tomselect ?? null;
    }

    return element;
}

function prepareTomSelectConfig(searchUrl = null, extraConfig = {}) {
    let config = defaultTomSelectConfig;

    // Eğer search varsa tom select inptunu aranabilir config ayarlarını ekler
    if (searchUrl) {
        config = { ...config, ...remoteSearchConfig(searchUrl)};
    }

    return { ...config, ...extraConfig };
}

function setStyleFlowbite(inputEl, instance) {
    const layoutClass = /^(?:[\w-]+:)*(?:block|inline-block|flex|inline-flex|grid|hidden|w-|min-w-|max-w-|basis-|grow|shrink)/;
    const invalid = inputEl.getAttribute("aria-invalid") === "true";

    for (const className of (inputEl.getAttribute("class") || "").split(/\s+/)) {
        if (className === "" || className === "tomselected" || className === "ts-hidden-accessible" || layoutClass.test(className)) {
            continue;
        }

        instance.wrapper.classList.remove(className);
    }

    if (invalid) {
        instance.wrapper.classList.add("is-invalid");
    }
}
