<template>

    <!-- Modal toggle -->
    <button class="text-white p-2 px-4 shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" @click="onToggle">
        ลงทะเบียน
    </button>

    <!-- Main modal -->
    <div id="app" class="h-full w-full flex items-center justify-center">
        <transition name="fade">
            <div v-if="isModalVisible" class="fixed inset-0 z-30">
                <div @click="onToggle" class="bg-filter bg-white opacity-25 fixed inset-0 w-full h-full z-20"></div>
                <div class="flex flex-col items-center justify-center h-full w-full">
                    <div class="modal-wrapper flex items-center z-30">
                        <div
                            class="modal max-w-md mx-auto xl:max-w-5xl lg:max-w-5xl md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative">
                            <div class="modal-header flex p-2.5 md:p-4 rounded-t border-b border-gray-200 bg-[#F2F2F2] shadow">
                                <h3 class="text-base md:text-lg font-semibold text-gray-900">
                                    ยืนยันการลงทะเบียน
                                </h3>
                                <button @click="onToggle" type="button"
                                        class="text-gray-600 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                        data-modal-toggle="defaultModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="modal-body p-5 w-full h-full overflow-y-auto ">
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    ชื่อ - นามสกุล: <span class="text-black">{{ employee.name }}</span>
                                </p>
                                <p class="text-sm md:text-base my-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    หน่วยงาน: <span class="text-black">{{ organizer_name }}</span>
                                </p>
                                <p class="text-sm md:text-base my-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    เข้าร่วม / ไม่เข้าร่วมงาน <span v-if="this.error === 'answer'"
                                                                    class="ml-3 text-red-500 text-sm">กรุณาเลือกคำตอบ</span>
                                </p>
                                <ul class="flex max-w-md">
                                    <li class="relative mr-4">
                                        <input @click="showInput" class="sr-only peer" type="radio" value="yes"
                                               name="answer" id="answer_yes" v-model="data.answer">
                                        <label
                                            class="py-2 px-7 flex justify-center bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:shadow-lg peer-checked:pr-10"
                                            for="answer_yes">
                                            เข้าร่วมงาน
                                        </label>
                                        <div class="absolute hidden w-5 h-5 peer-checked:block top-2 right-4">
                                            <img src="https://cdn-icons-png.flaticon.com/512/390/390973.png"
                                                 alt="check_icon">
                                        </div>
                                    </li>

                                    <li class="relative">
                                        <input @click="hideInput" class="sr-only peer" type="radio" value="no"
                                               name="answer" id="answer_no" v-model="data.answer">
                                        <label
                                            class="py-2 px-6 flex justify-center bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-red-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:shadow-lg peer-checked:pr-10"
                                            for="answer_no">
                                            ไม่เข้าร่วมงาน
                                        </label>
                                        <div class="absolute hidden w-4 h-4 peer-checked:block top-3 right-4">
                                            <img src="https://cdn-icons-png.flaticon.com/512/594/594864.png"
                                                 alt="cancel_icon">
                                        </div>
                                    </li>
                                </ul>
                                <div id="email_container" class="hidden mt-6">
                                    <label for="email">อีเมล: </label>
                                    <input v-model="data.email" type="email" name="email" id="email"
                                           class="px-2 bg-gray-50 border border-gray-300 rounded-lg py-1 ml-1"
                                           placeholder="example@ku.th">
                                    <p class="text-xs text-gray-500 mt-2">(ใช้ในการส่งลิงก์ QR Code เพื่อใช้สำหรับเข้าร่วมงาน)</p>
                                    <p v-if="this.error === 'email_1'" class="text-red-500 mt-2 text-xs md:text-sm">กรุณากรอกอีเมล</p>
                                    <p v-if="this.error === 'email_2'" class="text-red-500 mt-2 text-xs md:text-sm">
                                        อีเมลนี้ถูกใช้ไปแล้ว</p>
                                </div>
                            </div>
                            <div class="modal-footer mb-4 px-5">
                                <div class="flex items-center justify-center space-x-2 rounded-b">
                                    <button @click="onToggle"
                                            class="text-gray-500 mr-2 bg-gray-50 hover:bg-gray-200 shadow rounded-lg border border-[#DADADA] px-6 py-2">
                                        ยกเลิก
                                    </button>
                                    <button @click="submitForm" type="button"
                                            class="text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534] px-8 py-2 flex">
                                        <svg v-if="waiting" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        ตกลง
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import axios from 'axios';


export default {
    data() {
        return {
            isOpen: false,
            data: {
                employee_id: parseInt(this.employee.id),
                answer: '',
                email: '',
            },
            error: null,
            waiting: false,
        }
    },
    computed: {
        isModalVisible() {
            this.clear()
            return this.isOpen;
        }
    },
    props: {
        employee: {
            type: Object,
            required: true,
        },
        organizer_name: {
            type: String,
            required: true,
        },
        url: {
            type: String,
            required: true,
        },
    },
    methods: {
        onToggle() {
            this.isOpen = !this.isOpen;
        },
        showInput() {
            document.getElementById('email_container').style.display = "block";
        },
        hideInput() {
            document.getElementById('email_container').style.display = "none";
        },
        async submitForm() {
            this.waiting = true;
            this.error = null;
            try {
                const response = await axios.post(this.url + '/api/register/store', this.data)
                this.alert();
            } catch (e) {
                if (this.data.answer === '')
                    this.error = "answer"
                else if (this.data.email === '')
                    this.error = "email_1"
                else
                    this.error = "email_2"
            }
            this.waiting = false;
        },
        alert() {
            Swal.fire({
                title: 'ดำเนินการสำเร็จ',
                html: 'QR Code จะแสดงในอีก <b></b> วินาที',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,                timerProgressBar: true,
                didOpen: () => {
                    timerInterval = setInterval(() => {
                        Swal.getHtmlContainer().querySelector('b')
                            .textContent = (Swal.getTimerLeft() / 1000)
                                .toFixed(0)
                    }, 100)
                }
            }).then(async () => {
                if (this.data.answer === "no") {
                    window.open(`/`, '_self');
                }
                else {
                    let qr_code = null;
                    try {
                        const response = await axios.get(this.url + `/api/employee/${this.employee.id}`);
                        qr_code = response.data.employee.qr_code;
                        window.open(`/qr-code/${qr_code}`, '_self');
                    } catch (e) {
                        console.log(e);
                    }
                }
            });
        },
        clear() {
            this.data.answer = '';
            this.data.email = '';
            this.error = null;
        }
    },
}
</script>
