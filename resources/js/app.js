import './bootstrap';

import { createApp } from 'vue'
import Hello from "./components/Hello";
import RegisterPopup from "./components/RegisterPopup";
import EmployeeCard from "./components/EmployeeCard";
import CountDown from "./components/CountDown";
import CountDownButMini from "./components/CountDownButMini";
import MqttTest from "./components/MqttTest";
import BigRedButton from "./components/BigRedButton";
import PrizePopup from "./components/PrizePopup";
import PrizeDraw from "./components/PrizeDraw";
import ScanQrcode from "./components/ScanQrcode";
import VueSweetalert2 from 'vue-sweetalert2';
import VueQrcodeReader from 'vue3-qrcode-reader';

const app = createApp({})

app.component('hello', Hello);
app.component('register-popup', RegisterPopup);
app.component('employee-card', EmployeeCard)
app.component('count-down', CountDown);
app.component('mini-count-down', CountDownButMini);
app.component('mqtt-test', MqttTest);
app.component('big-red-button', BigRedButton);
app.component('prize-popup', PrizePopup);
app.component('prize-draw', PrizeDraw);
app.component('scan-qr-code', ScanQrcode);

app.use(VueQrcodeReader);
app.use(VueSweetalert2);
app.mount('#app')
