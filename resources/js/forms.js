/**
 * Bu dosyanın amacı formdaki verileri toplamak ve belirtilen route'a istek atmaktır
 */

const methodOverrides = ["PUT", "PATCH", "DELETE"];

window.submitForm = function (formSelector, url, method = "POST") {
    /**
     * Değişken tanımlama işlemi üç farklı key ile yapılabilir. (var, let, const)
     *
     * var ve let keyleri sonradan güncellenebilir keylerdir.
     * const keyi ise değişmez keydir
     */

    const form = document.querySelector(formSelector);

    if (!form) {
        throw new Error("Form bulunamadı.");
    }

    clearFormErrors(form);

    axios
        .post(url, collectFormData(form, method))
        .then((response) => {
            const message = response.data?.message ?? 'İşlem başarılı.';
            const redirect = safeRedirect(response.data?.redirect);

            // Sayfa değişince mevcut toast silinir. Mesaj bir sonraki yüklemede bir kez gösterilir.
            window.flashToast(message, 'success');

            if (redirect) {
                window.location.assign(redirect);
                return;
            }

            window.location.reload();
        })
        .catch((error) => {
            const response = error.response;
            const message = response?.data?.message ?? 'Bir hata oluştu.';

            // 422, Laravel doğrulama hatasıdır. Alan adları errors içinde gelir.
            if (response?.status === 422 && response.data?.errors) {
                showFieldErrors(form, response.data.errors);
            }

            window.showToast(message, 'error');
        });
};

window.collectFormData = function (form, method = "POST") {
    const formData = new FormData();
    const normalizedMethod = String(method || "POST").trim().toUpperCase();

    for (const field of form.elements) {
        if (!isSuccessfulControl(field)) {
            continue;
        }

        appendControl(formData, field);
    }

    // Blade içindeki gizli _method, submitForm'a verilen method'un önüne geçmesin.
    formData.delete("_method");

    if (methodOverrides.includes(normalizedMethod)) {
        formData.set("_method", normalizedMethod);
    }

    return formData;
};

function isSuccessfulControl(field) {
    if (!field.name || field.disabled) {
        return false;
    }

    const tagName = field.tagName;

    if (tagName !== "INPUT" && tagName !== "TEXTAREA" && tagName !== "SELECT") {
        return false;
    }

    const type = field.type;

    if (type === "submit" || type === "button" || type === "reset" || type === "image") {
        return false;
    }

    // Seçili olmayan radio gönderilmez. Checkbox seçili olmasa da 0 olarak gider.
    if (type === "radio" && !field.checked) {
        return false;
    }

    return true;
}

function appendControl(formData, field) {
    const name = field.name;

    if (field.type === "checkbox") {
        formData.append(name, field.checked ? "1" : "0");
        return;
    }

    if (field.type === "file") {
        for (const file of field.files ?? []) {
            formData.append(name, file);
        }
        return;
    }

    if (field.tagName === "SELECT" && field.multiple) {
        for (const option of field.selectedOptions) {
            formData.append(name, option.value);
        }
        return;
    }

    // name="test[]", name="test[test[]]", name="test[][test[]]" Laravel'in
    // dizi çözümlemesi için olduğu gibi gönderilir.
    formData.append(name, field.value);
}

function safeRedirect(value) {
    if (typeof value !== 'string') {
        return null;
    }

    const candidate = value.trim();

    if (candidate === '' || candidate.startsWith('//') || candidate.includes('\\')) {
        return null;
    }

    let url;

    try {
        url = new URL(candidate, window.location.origin);
    } catch {
        return null;
    }

    if (url.origin !== window.location.origin || (url.protocol !== 'http:' && url.protocol !== 'https:')) {
        return null;
    }

    return `${url.pathname}${url.search}${url.hash}`;
}

function clearFormErrors(form) {
    form.querySelectorAll('[data-form-error]').forEach((message) => {
        message.remove();
    });

    form.querySelectorAll('[data-original-class]').forEach((element) => {
        element.className = element.dataset.originalClass;
        delete element.dataset.originalClass;
    });

    form.querySelectorAll('[aria-invalid="true"]').forEach((field) => {
        field.removeAttribute('aria-invalid');
        field.removeAttribute('aria-describedby');
    });
}

function showFieldErrors(form, errors) {
    Object.entries(errors).forEach(([key, messages]) => {
        const fields = fieldsForErrorKey(form, key);
        const text = (Array.isArray(messages) ? messages : [messages]).filter(Boolean).join(' ');

        if (!text || fields.length === 0) {
            return;
        }

        fields.forEach((field, index) => {
            markInvalid(field);

            if (index !== 0) {
                return;
            }

            const errorId = `error-${key.replace(/[^a-zA-Z0-9_-]/g, '-')}`;
            const message = document.createElement('p');
            message.id = errorId;
            message.dataset.formError = key;
            message.className = 'mt-2 text-sm text-fg-danger';
            message.textContent = text;

            field.setAttribute('aria-describedby', errorId);

            const anchor = field.type === 'checkbox' || field.type === 'radio'
                ? (field.closest('label') ?? field)
                : field;

            anchor.insertAdjacentElement('afterend', message);
        });
    });
}

function fieldsForErrorKey(form, key) {
    const fields = [];

    namesForErrorKey(key).forEach((name) => {
        fields.push(...form.querySelectorAll(`[name="${CSS.escape(name)}"]`));
    });

    return [...new Set(fields)];
}

function namesForErrorKey(key) {
    const names = new Set([key, key.endsWith('[]') ? key.slice(0, -2) : `${key}[]`]);
    const segments = key.split('.');

    if (segments.length < 2) {
        return [...names];
    }

    const [root, ...rest] = segments;
    names.add(root);
    names.add(`${root}[]`);

    const namedSegments = rest.filter((segment) => !/^\d+$/.test(segment));

    if (namedSegments.length > 0) {
        names.add(`${root}[${namedSegments.join('][')}]`);
        names.add(`${root}[][${namedSegments.join('][')}]`);
    }

    return [...names];
}

function markInvalid(field) {
    const target = field.classList.contains('sr-only') && field.nextElementSibling
        ? field.nextElementSibling
        : field;

    if (!target.dataset.originalClass) {
        target.dataset.originalClass = target.className;
    }

    target.classList.remove(
        'border-default-medium',
        'bg-neutral-secondary-medium',
        'focus:border-brand',
        'focus:ring-brand',
    );

    if (target === field) {
        target.classList.add('border-danger', 'bg-danger-soft', 'focus:border-danger', 'focus:ring-danger-medium');
    } else {
        target.classList.add('ring-2', 'ring-danger');
    }

    field.setAttribute('aria-invalid', 'true');
}
