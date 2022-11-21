import './bootstrap';

import { createApp } from 'vue'
import Hello from "./components/Hello";
import CountDown from "./components/CountDown";
import MqttTest from "./components/MqttTest";

const app = createApp({})

app.component('hello', Hello);
app.component('count-down', CountDown);
app.component('mqtt-test', MqttTest);

app.mount('#app')
