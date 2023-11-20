/*

import './bootstrap';
import { createApp } from 'vue';



const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

// Object.entries(import.meta.glob('./!**!/!*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });
app.mount('#app');

*/

import './bootstrap';
import {createApp} from 'vue'
import App from './App.vue'
import { createStore } from 'vuex';
import router from './router/router';
import store from './store';

const  app = createApp(App);
app.use(store);
app.use(router);

app.mount("#app")

