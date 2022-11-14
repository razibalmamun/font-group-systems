import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import './assets/main.css'

import "bootstrap"
import "bootstrap/dist/css/bootstrap.min.css"

import axios from 'axios'
import VueAxios from 'vue-axios'

import Toaster from '@meforma/vue-toaster'

const app = createApp(App)
app.use(router)
app.use(Toaster)
app.use(VueAxios, axios)
axios.defaults.baseURL = import.meta.env.VITE_BASEURL || '';
app.mount('#app')
