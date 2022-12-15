import './bootstrap';

import { createApp } from 'vue'
import Hello from "./components/Hello";
import RegisterPopup from "./components/RegisterPopup";
import EmployeeCard from "./components/EmployeeCard";
import CountDown from "./components/CountDown";
import MqttTest from "./components/MqttTest";
import SideBar from "./components/SideBar";
import VueSweetalert2 from 'vue-sweetalert2';

const app = createApp({})

app.component('hello', Hello);
app.component('register-popup', RegisterPopup);
app.component('employee-card', EmployeeCard)
app.component('count-down', CountDown);
app.component('mqtt-test', MqttTest);
app.component('side-bar', SideBar);

app.use(VueSweetalert2);
app.mount('#app')
