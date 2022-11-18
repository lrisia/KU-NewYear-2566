import './bootstrap';

import { createApp } from 'vue'
import Hello from "./components/Hello";

const app = createApp({})

app.component('hello', Hello);


app.mount('#app')
