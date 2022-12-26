<template>
    <div v-if="!this.drawing" style="width: 100%" class="relative">
        <div class="flex h-screen">
            <img class="mx-auto" id="cover" src="/image/Banner-full.png" alt="KU NewYear Poster">
        </div>
        <video class="h-screen absolute top-0 left-0 fade" id="video-draw">
            <source :src="'/video/' + this.video_name" type="video/mp4" >
        </video>
    </div>
    <div v-else style="background-color: #CFE4E0;">
        <div class="flex flex-row h-screen mr-10">
            <div class="mx-auto flex flex-col justify-center">
                <h1 v-if="prize_data" class="mt-6 mx-10 sm:text-xl md:text-3xl lg:text-4xl 2k:text-5xl">รายชื่อผู้ได้รับ <span class="text-4xl lg:text-6xl 2k:text-7xl ">{{ prize_data.type }} </span> {{ prize_data.description }} จำนวน {{ prize_data.total_amount }} รางวัล</h1>
                <div class="mt-10 my-6 mx-10 table-auto overflow-x-auto max-h-screen sm:text-xl lg:text-3xl 2k:text-5xl shadow-md rounded-xl">
                    <table class="w-full text-left text-gray-60 mr-0">
                        <thead class="bg-[#006B67] text-white sm:text-xl lg:text-3xl 2k:text-5xl sticky top-0">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-center">ลำดับ</th>
                            <th scope="col" class="py-3 px-6">ชื่อ-นามสกุล</th>
                            <th scope="col" class="py-3 pl-2">หน่วยงาน</th>
                        </tr>
                        </thead>
                        <tbody class="m-2 overflow-y-auto bg-white">
                            <tr v-for="(person, index) in lucky_person" class="border-t text-gray-700 sm:text-xl lg:text-3xl 2k:text-5xl">
                                <td class="px-6 py-3 text-center">{{ index + 1 }}</td>
                                <td class="px-6 py-3">{{ person.name }}</td>
                                <td class="py-3 pl-2 pr-4">{{ person.organizer }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-auto my-10 flex flex-col items-center justify-center">
                <div class="mt-16 p-6 rounded-lg bg-white">
                    <qrcode-vue :value="this.qrcode_url" class="mx-auto" :size="400" />
                </div>
                <div class="mt-7 mb-16">
                    <mini-count-down :minute="15"></mini-count-down>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mqtt from "mqtt";
import QrcodeVue from 'qrcode.vue'
import axios from 'axios';

export default {
    data() {
        return {
            connection: {
                protocol: "wss",
                host: "mqtt.evwin.ku.ac.th",
                port: 8080,
                endpoint: "/",

                username: "kunewyear",
                password: "KU-newyear-2566",

                // for more options, please refer to https://github.com/mqttjs/MQTT.js#mqttclientstreambuilder-options
                clean: true,
                connectTimeout: 60 * 1000, // ms
                reconnectPeriod: 4000, // ms
                clientId: "raeywenuk" + Math.random().toString(16).substring(2, 8),
                keepalive: 60

            },
            client: {
                connected: false,
            },
            retryTimes: 0,
            connecting: false,
            subscribeSuccess: false,
            drawing: false,
            lucky_person: null,
            qrcode_url: "",
            prize_data: null,
        }
    },
    components: { QrcodeVue, },
    props: {
        url: {
            type: String,
            required: true,
        },
        url_for_qrcode: {
            type: String,
            required: true,
        },
        video_name: {
            type: String,
            required: true,
        }
    },
    mounted() {
        this.createConnection()
    },
    methods: {
        initData() {
            this.client = {
                connected: false,
            };
            this.retryTimes = 0;
            this.connecting = false;
            this.subscribeSuccess = false;
        },
        createConnection() {
            try {
                this.connecting = true;
                const {protocol, host, port, endpoint, ...options} = this.connection;
                const connectUrl = `${protocol}://${host}:${port}${endpoint}`;
                this.client = mqtt.connect(connectUrl, options);
                if (this.client.on) {
                    this.client.on("connect", () => {
                        this.connecting = false;
                        // console.log("Connection succeeded!");
                        this.doSubscribe({topic: "kunewyear2566/#", qos: 0})
                    });
                    this.client.on("reconnect", this.handleOnReConnect);
                    this.client.on("error", (error) => {
                        console.log("Connection failed", error);
                    });
                    this.client.on("message", (topic, message) => {
                        if (topic.toString() === "kunewyear2566/draw-prize") {
                            this.qrcode_url = this.url_for_qrcode + '/' + message.toString();
                            this.transitionHandle(message);
                        } else if (topic.toString() === "kunewyear2566/close-prize") {
                            location.reload();
                        }
                        // console.log(`Received message ${message} from topic ${topic}`);
                    });
                }
            } catch (error) {
                this.connecting = false;
                console.log("mqtt.connect error", error);
            }
        },
        handleOnReConnect() {
            this.retryTimes += 1;
            if (this.retryTimes > 5) {
                try {
                    this.client.end();
                    this.initData();
                    console.error("Connection maxReconnectTimes limit, stop retry");
                } catch (error) {
                    console.error(error.toString());
                }
            }
        },
        doSubscribe(subscription) {
            const {topic, qos} = subscription
            this.client.subscribe(topic, {qos}, (error, res) => {
                if (error) {
                    console.log('Subscribe to topics error', error);
                    return
                }
                this.subscribeSuccess = true;
                // console.log('Subscribe to topics res', res)
            })
        },
        transitionHandle(prize_id) {
            var cover = document.getElementById("cover");
            var video = document.getElementById("video-draw");
            cover.classList.add('fade-out');
            setTimeout(() => {
                // cover.hidden = true;
                // video.hidden = false;
                video.style.opacity = "100%";
                video.classList.add('fade-in');
            }, 1000);
            setTimeout(() => video.play(), 1000);
            setTimeout(() => this.getLuckyPerson(prize_id), 17000); // ms
        },
        async getLuckyPerson(prize_id) {
            try {
                const response = await axios.get(this.url + `/api/prize/${prize_id}/employee`);
                const prize = await axios.get(this.url + `/api/prize/${prize_id}/get`);
                this.lucky_person = response.data;
                this.prize_data = prize.data;
                this.drawing = true;
            } catch (e) {
                console.log(e);
            }
        }
    },
}
</script>

<style>
.fade-out {
    opacity: 0%;
    transition: opacity 1s;
}
.fade-in {
    opacity: 100%;
    transition: opacity 1s;
}
.fade {
    opacity: 0%;
}
</style>
