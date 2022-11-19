import './bootstrap';

import { createApp } from 'vue'
import Hello from "./components/Hello";
import CountDown from "./components/CountDown";

const app = createApp({})

app.component('hello', Hello);
app.component('count-down', CountDown);


app.mount('#app')
