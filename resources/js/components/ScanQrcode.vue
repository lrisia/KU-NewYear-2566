<template>
    <div class="mx-8 min-h-screen">
        <div class="grid place-items-center">
            <button class="items-center py-2 px-4 font-bold text-xl bg-[#B0C03B] text-white rounded-lg shadow-lg my-8 hover:bg-[#98a534]" @click="this.camera = 'auto'">เปิดกล้อง</button>
        </div>

        <div class="square mx-auto border-4 border-dashed min-w-xl">
            <qrcode-stream class="content" :camera="camera" @decode="onDecode" @init="onInit">
                <div v-show="showScanConfirmation" class="scan-confirmation">
                    <img src="/image/checkmark.svg" alt="Checkmark" width="128px"/>
                </div>
            </qrcode-stream>
        </div>

        <div id="info" class="hidden max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md mx-auto mt-8">
            <div class="modal-body p-5 w-full h-full overflow-y-auto ">
                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                    ชื่อ - นามสกุล: <span id="name" class="text-black"></span>
                </p>
                <p class="text-sm md:text-base my-4 leading-relaxed text-gray-500 dark:text-gray-400">
                    หน่วยงาน: <span id="organizer" class="text-black"></span>
                </p>
            </div>
            <a @click="storeAttend" class="inline-flex items-center text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534] ml-4 px-8 py-2 text-center focus:ring-4 focus:outline-none focus:ring-blue-300">
                เข้าร่วมงาน
                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
    </div>
</template>

<script>
import { QrcodeStream } from 'vue3-qrcode-reader'
import axios from 'axios';

export default {
    components: { QrcodeStream },
    data () {
        return {
            camera: 'off',
            showScanConfirmation: false,
            employee: null,
        }
    },
    methods: {
        async onInit (promise) {
            try {
                await promise
            } catch (e) {
                console.error(e)
            } finally {
                this.showScanConfirmation = this.camera === "off"
            }
        },
        async onDecode (content) {
            try {
                const response = await axios.get(this.get_employee_api_url + `?qr_code=${content}`)
                this.employee = response.data.employee
                console.log(this.employee)
                document.getElementById('info').style.display = 'block'
                document.getElementById('name').textContent = this.employee.name
                document.getElementById('organizer').textContent = this.employee.organizer
            } catch (e) {
                console.error(e)
            }
            this.pause()
        },
        unpause () {
            this.camera = 'auto'
        },
        pause () {
            this.camera = 'off'
        },
        async storeAttend() {
            const response = await axios.post(this.store_attend_url, {"qr_code": this.employee.qr_code})
            if (response.status === 200) {
                location.reload();
            }
        }
    },
    props: {
        get_employee_api_url: {
            type: String,
            required: true,
        },
        store_attend_url: {
            type: String,
            required: true,
        }
    }
}
</script>

<style scoped>
.scan-confirmation {
    position: absolute;
    width: 100%;
    height: 100%;

    background-color: rgba(255, 255, 255, .8);

    display: flex;
    flex-flow: row nowrap;
    justify-content: center;
}

.square {
    position: relative;
    width: 100%;
}

.square:after {
    content: "";
    display: block;
    padding-bottom: 100%;
}

.content {
    position: absolute;
    width: 100%;
    height: 100%;
}
</style>
