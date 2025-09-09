import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';

// 1. Busca el elemento #app en el DOM.
const appElement = document.getElementById('app');

// 2. Extrae los datos del atributo `data-posts` y conviértelos de JSON a un objeto JavaScript.
//    Usamos `|| '[]'` como respaldo para evitar errores si el atributo no existe.
const props = {
    posts: JSON.parse(appElement.dataset.posts || '[]'),
};

// 3. Crea la aplicación Vue, pasando los datos extraídos como props al componente raíz `App`.
createApp(App, props).mount(appElement);