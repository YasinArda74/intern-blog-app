import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

if (csrfToken) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}


/**
 * Yazılan parametreleri, fonksiyonları veya classları tüm projeye yayınlamak ve kullanabilmek için "window" keyi kullanılır.
 *
 * "document" key'i açık olan sayfanın içerisinde işlem yapmamı sağlayan keydir.
 * querySelector: açık olan sayfa içerisindeki tagleri seçmene yarar. (single)
 * querySelectorAll: açık olan sayfa içerisindeki tagleri seçmene yarar. (multi)
 * getElementById: açık olan sayfa içerisindeki tagleri id yolu ile seçmene yarar. (single)
 *
 */
