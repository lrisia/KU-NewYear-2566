<template>
    <div class="h-screen relative">
        <div v-if="this.enable" class="">
            <button id="red" style="margin-bottom: 30px" @click="pressButton(this.prize.id)">จับรางวัล</button>
            <h1 class="text-4xl  text-center">จับ{{ this.prize.type }}<br>{{ this.prize.description}}</h1>
        </div>
        <div v-else>
            <button id="gray" disabled>จับรางวัล</button>
        </div>
    </div>
</template>

<style>
#red {
    outline: none;
    font-size: 2em;
    color: rgba(255, 255, 255, 1);
    text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.7), 1px 1px 1px rgba(255, 255, 255, 0.3);
    display: block;
    margin: 10em auto;
    padding: 23px 37px 25px 35px;
    cursor: pointer;
    background-color: rgba(46, 5, 12, 1);
    background-image: linear-gradient(273deg, rgba(235, 71, 99, 1) 30%, rgba(230, 26, 60, 1) 40%);
    border: none;
    border-radius: 16px;
    box-shadow: inset 0px 0px 1px 1px rgba(138, 15, 36, 0.9), inset 0px 0px 2px 3px rgba(230, 26, 60, 0.9), inset 1px 1px 1px 4px rgba(255, 255, 255, 0.8), inset 0px 0px 2px 7px rgba(235, 71, 99, 0.8), inset 0px 0px 4px 10px rgba(230, 26, 60, 0.9), 8px 10px 2px 6px rgba(92, 10, 24, 0.55), 0px 0px 3px 2px rgba(184, 20, 48, 0.9), 0px 0px 2px 6px rgba(230, 26, 60, 0.9), -1px -1px 1px 6px rgba(255, 255, 255, 0.9), 0px 0px 2px 11px rgba(230, 26, 60, 0.9), 0px 0px 1px 12px rgba(184, 20, 48, 0.9), 1px 3px 14px 14px rgba(0, 0, 0, 0.4);
}

#red:active {
    color: rgba(217, 217, 217, 1);
    padding: 26px 34px 22px 38px;
    background-image: linear-gradient(273deg, rgba(230, 26, 60, 1) 50%, rgba(232, 48, 79, 1) 60%);
    box-shadow: inset 3px 4px 3px 2px rgba(92, 10, 24, 0.55), inset 0px 0px 1px 1px rgba(138, 15, 36, 0.9), inset -1px -1px 2px 3px rgba(230, 26, 60, 0.9), inset -2px -2px 1px 3px rgba(255, 255, 255, 0.8), inset 0px 0px 2px 7px rgba(235, 71, 99, 0.8), inset 0px 0px 3px 10px rgba(230, 26, 60, 0.9), 0px 0px 3px 2px rgba(184, 20, 48, 0.9), 0px 0px 2px 6px rgba(230, 26, 60, 0.9), -1px -1px 1px 6px rgba(255, 255, 255, 0.9), 0px 0px 2px 11px rgba(230, 26, 60, 0.9), 0px 0px 1px 12px rgba(184, 20, 48, 0.9), 1px 3px 14px 14px rgba(0, 0, 0, 0.4);
    /*0px 0px 2px 3px hsla(350,80%,60%,0.9),*/
    /*0px 0px 2px 8px hsla(350,80%,60%,0.9),*/
}

#gray {
    outline: none;
    font-size: 2em;
    color: rgb(176, 169, 169);
    text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.7), 1px 1px 1px rgba(255, 255, 255, 0.3);
    display: block;
    margin: 10em auto;
    padding: 23px 37px 25px 35px;
    cursor: pointer;
    background-color: rgb(45, 45, 45);
    background-image: linear-gradient(273deg, rgb(66, 66, 66) 30%, rgb(72, 72, 72) 40%);
    border: none;
    border-radius: 16px;
    box-shadow: inset 0px 0px 1px 1px rgb(136, 135, 135), inset 0px 0px 2px 3px rgba(28, 22, 23, 0.9), inset 1px 1px 1px 4px rgba(255, 255, 255, 0.8), inset 0px 0px 2px 7px rgba(150, 150, 150, 0.8), inset 0px 0px 4px 10px rgba(216, 216, 216, 0.9), 8px 10px 2px 6px rgba(92, 92, 92, 0.55), 0px 0px 3px 2px rgba(184, 184, 184, 0.9), 0px 0px 2px 6px rgba(230, 230, 230, 0.9), -1px -1px 1px 6px rgba(215, 215, 215, 0.9), 0px 0px 2px 11px rgba(230, 230, 230, 0.9), 0px 0px 1px 12px rgba(184, 184, 184, 0.9), 1px 3px 14px 14px rgba(0, 0, 0, 0.4);
}
</style>

<script>
import mqtt from "mqtt"
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
            enable: false,
            prize: null
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
                const { protocol, host, port, endpoint, ...options } = this.connection;
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
                    this.client.on("message", async (topic, message) => {
                        if (topic.toString() === "kunewyear2566/enable-prize") {
                            await this.getPrize(message.toString())
                            this.enable = true;
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
            const { topic, qos } = subscription
            this.client.subscribe(topic, { qos }, (error, res) => {
                if (error) {
                    console.log('Subscribe to topics error', error);
                    return
                }
                this.subscribeSuccess = true;
                // console.log('Subscribe to topics res', res)
            })
        },
        async getPrize(id) {
            try {
                let url = this.url + '/api/prize/' + id + "/get";
                const response = await axios.get(url);
                this.prize = response.data;
            } catch (e) {
                console.error(e);
            }
        },
        async pressButton(id) {
            this.enable = false;
            try {
                const response = await axios.get(this.url + '/api/prize/' + id + '/draw');
            } catch (e) {
                console.error(e);
                this.enable = true;
            }
        }
    },
    props: {
        url: {
            type: String,
            required: true,
        },
    }
}
</script>
