import './bootstrap';

import { createApp } from 'vue'
// import { createPinia } from 'pinia'

import App from './App.vue'

// createApp(App).mount('#app')

import ItemsIndex from './components/Items/Index.vue'
import HelloWorld from "@/components/HelloWorld.vue";

// const app = createApp()
//
// app.use(createPinia())
// app.use(router)
//
// app.mount('#app')



createApp({})
    .component('ItemsIndex', ItemsIndex)
    .mount('#app')
