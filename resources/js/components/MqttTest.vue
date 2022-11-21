<template>
    <div>MQTT Test Component</div>

</template>

<script>
// import { useMQTT } from 'mqtt-vue-hook'
//
// const mqttHook = useMQTT()

export default {

    mounted() {
        // mqttHook.connect(`mqtt://mqtt.evwin.ku.ac.th:1883`, {
        //     clean: true,
        //     keepalive: 60,
        //     protocolId: 'MQIsdp',
        //     protocolVersion: 3,
        //     protocol: 'mqtt',
        //     username: 'test',
        //     password: 'test',
        //     clientId: `ku-newyear_${Math.random().toString(16).substring(2, 10)}`,
        //     connectTimeout: 4000,
        // })
        //
        // mqttHook.subscribe(['newyear/test'])
        //
        // mqttHook.registerEvent(
        //     'newyear/test', // mqtt status: on-connect, on-reconnect, on-disconnect, on-connect-fail
        //     (topic, message) => {
        //         console.log('mqtt connected')
        //     }
        // )
    }
}
</script>
