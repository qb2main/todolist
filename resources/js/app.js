import './bootstrap';
import { createApp } from 'vue';

import * as VueRouter from 'vue-router';
import * as Vuetify from "vuetify";

import 'vuetify/dist/vuetify.min.css';

import App from './components/Tasks/Index.vue'

const app = createApp(App)

app.mount('#app')
app.use(Vuetify)
app.use(VueRouter)


