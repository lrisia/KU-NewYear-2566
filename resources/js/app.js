import './bootstrap';

import { createApp } from 'vue'
import Hello from "./components/Hello";
import RegisterPopup from "./components/RegisterPopup";
import EmployeeCard from "./components/EmployeeCard";
import CountDown from "./components/CountDown";
import MqttTest from "./components/MqttTest";
import SideBar from "./components/SideBar";
import BigRedButton from "./components/BigRedButton";
import PrizeDraw from "./components/PrizeDraw";
import ScanQrcode from "./components/ScanQrcode";
import VueSweetalert2 from 'vue-sweetalert2';
import VueQrcodeReader from 'vue3-qrcode-reader';

const app = createApp({})

app.component('hello', Hello);
app.component('register-popup', RegisterPopup);
app.component('employee-card', EmployeeCard)
app.component('count-down', CountDown);
app.component('mqtt-test', MqttTest);
app.component('side-bar', SideBar);
app.component('big-red-button', BigRedButton);
app.component('prize-draw', PrizeDraw);
app.component('scan-qr-code', ScanQrcode);

app.use(VueQrcodeReader);
app.use(VueSweetalert2);
app.mount('#app')
