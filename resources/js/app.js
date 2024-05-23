import './bootstrap';
import {createApp} from "vue";
import App from "./src/App.vue"
import Router from "./src/router/router.js";

const app = createApp(App);
app.use(Router);
app.mount('#app');
