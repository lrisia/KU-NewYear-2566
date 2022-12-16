<template>
    <div style="width: 100%">
        <img :src="this.url + '/image/2565.png'" alt="KU NewYear Poster">
    </div>
</template>

<script>
import mqtt from "mqtt";

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
        }
    },
    props: {
        url: {
            type: String,
            required: true,
        },
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
                        console.log("Connection succeeded!");
                        this.doSubscribe({topic: "kunewyear2566/#", qos: 0})
                    });
                    this.client.on("reconnect", this.handleOnReConnect);
                    this.client.on("error", (error) => {
                        console.log("Connection failed", error);
                    });
                    this.client.on("message", (topic, message) => {
                        console.log(topic.toString());
                        // มันไม่เข้าตรงนี้ง่ะ
                        if (topic.toString() === "kunewyear2566/draw-prize") {
                            window.open(this.url + "/lucky-draw/draw");
                        }
                        console.log(`Received message ${message} from topic ${topic}`);
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
    },
}
</script>
