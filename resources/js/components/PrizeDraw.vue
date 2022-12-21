<template>
    <div v-if="!this.drawing" style="width: 100%" class="relative">
        <img class="absolute top-0 left-0" id="cover" src="/image/2565.png" alt="KU NewYear Poster">
        <video class="absolute top-0 left-0" id="video-draw" muted hidden>
            <source src="/video/lucky-draw-chest.mp4" type="video/mp4" >
        </video>
    </div>
    <div v-else>
        <div v-for="person in lucky_person">
            <p>{{ person.name }}</p>
        </div>
        <div>
            <mini-count-down></mini-count-down>
        </div>
        <div>
            <qrcode-vue :value="this.qrcode_url"/>
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
            cover.hidden = true;
            video.hidden = false;
            video.play()
            setTimeout(() => this.getLuckyPerson(prize_id), 8000); // ms
        },
        async getLuckyPerson(prize_id) {
            try {
                const response = await axios.get(this.url + `/api/prize/${prize_id}/employee`);
                this.lucky_person = response.data;
                this.drawing = true;
            } catch (e) {
                console.log(e);
            }
        }
    },
}
</script>
