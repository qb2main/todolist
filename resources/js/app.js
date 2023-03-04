import './bootstrap';
import { createApp } from 'vue';

import * as VueRouter from 'vue-router';
import App from './components/Tasks/Index.vue'

const app = createApp(App)

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
const vuetify = createVuetify({
    components,
    directives,
})



app.use(vuetify)
app.use(VueRouter)
app.mount('#app')




