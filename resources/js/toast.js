/**
 * Sayfanın sağ üstünde kısa süreli toast gösterir.
 * window.showToast ile her yerden çağrılabilir.
 */

const TOAST_VISIBLE_MS = 4000;
const FLASH_TOAST_KEY = 'flash-toast';

const toastStyles = {
    success: {
        panel: 'pointer-events-auto flex w-full items-center rounded-base border border-success-subtle bg-success-soft p-4 text-fg-success-strong shadow-xs transition-opacity duration-300',
        icon: 'inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-base bg-success-medium text-fg-success',
        symbol: 'fa-solid fa-circle-check',
    },
    error: {
        panel: 'pointer-events-auto flex w-full items-center rounded-base border border-danger-subtle bg-danger-soft p-4 text-fg-danger-strong shadow-xs transition-opacity duration-300',
        icon: 'inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-base bg-danger-medium text-fg-danger',
        symbol: 'fa-solid fa-circle-exclamation',
    },
};

window.showToast = function (message, type = 'success') {
    const style = toastStyles[type] ?? toastStyles.success;
    const stack = toastStack();
    const toast = document.createElement('div');
    const toastId = `toast-${window.crypto?.randomUUID?.() ?? Date.now()}`;

    toast.id = toastId;
    toast.setAttribute('role', 'status');
    toast.className = style.panel;

    const icon = document.createElement('span');
    icon.className = style.icon;
    icon.innerHTML = `<i class="${style.symbol}" aria-hidden="true"></i>`;

    const text = document.createElement('p');
    text.className = 'ms-3 text-sm font-medium';
    text.textContent = String(message ?? '');

    const closeButton = document.createElement('button');
    closeButton.type = 'button';
    closeButton.className = 'ms-auto inline-flex h-8 w-8 items-center justify-center rounded-base hover:bg-neutral-tertiary-medium focus:outline-none focus:ring-2 focus:ring-neutral-tertiary';
    closeButton.setAttribute('aria-label', 'Kapat');
    closeButton.setAttribute('data-dismiss-target', `#${toastId}`);
    closeButton.innerHTML = '<i class="fa-solid fa-xmark" aria-hidden="true"></i>';

    toast.append(icon, text, closeButton);
    stack.append(toast);

    const removeToast = () => {
        if (toast.isConnected) {
            toast.remove();
        }
    };

    const dismiss = window.Dismiss
        ? new window.Dismiss(toast, closeButton, {
            onHide() {
                window.setTimeout(removeToast, 300);
            },
        })
        : null;

    if (!dismiss) {
        closeButton.addEventListener('click', removeToast);
    }

    window.setTimeout(() => {
        if (!toast.isConnected) {
            return;
        }

        if (dismiss) {
            dismiss.hide();
            return;
        }

        removeToast();
    }, TOAST_VISIBLE_MS);
};

window.flashToast = function (message, type = 'success') {
    const text = String(message ?? '').trim().slice(0, 300);

    if (text === '') {
        return;
    }

    sessionStorage.setItem(FLASH_TOAST_KEY, JSON.stringify({
        message: text,
        type: type === 'error' ? 'error' : 'success',
    }));
};

consumeFlashToast();

function consumeFlashToast() {
    const raw = sessionStorage.getItem(FLASH_TOAST_KEY);

    if (!raw) {
        return;
    }

    sessionStorage.removeItem(FLASH_TOAST_KEY);

    let payload;

    try {
        payload = JSON.parse(raw);
    } catch {
        return;
    }

    if (!payload || typeof payload.message !== 'string' || payload.message.trim() === '') {
        return;
    }

    const show = () => {
        window.showToast(payload.message, payload.type === 'error' ? 'error' : 'success');
    };

    if (document.body) {
        show();
        return;
    }

    document.addEventListener('DOMContentLoaded', show, { once: true });
}

function toastStack() {
    let stack = document.getElementById('toast-stack');

    if (stack) {
        return stack;
    }

    stack = document.createElement('div');
    stack.id = 'toast-stack';
    stack.className = 'fixed top-5 right-5 z-[60] flex w-full max-w-sm flex-col gap-3';
    stack.setAttribute('aria-live', 'polite');
    document.body.append(stack);

    return stack;
}
