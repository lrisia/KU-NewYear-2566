<template>

    <!-- Modal toggle -->
    <button class="text-white p-2 px-4 shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" type="button" data-modal-toggle="defaultModal" @click="clear">
        ลงทะเบียน
    </button>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b border-gray-200 shadow">
                    <h3 class="text-xl font-semibold text-gray-900">
                        ยืนยันการลงทะเบียน
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        ชื่อ - นามสกุล: <span class="text-black">{{ employee.name }}</span>
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        หน่วยงาน: <span class="text-black">{{ organizer_name }}</span>
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        เข้าร่วม / ไม่เข้าร่วมงาน <span v-if="this.error === 'answer'" class="ml-4 text-red-500">กรุณาเลือกคำตอบ</span>
                    </p>
                    <ul class="flex max-w-md">
                        <li class="relative mr-6">
                            <input @click="showInput" class="sr-only peer" type="radio" value="yes" name="answer" id="answer_yes" v-model="data.answer">
                            <label class="py-2 pl-6 pr-14 flex bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:shadow-lg" for="answer_yes">
                                เข้าร่วมงาน
                            </label>
                            <div class="absolute hidden w-5 h-5 peer-checked:block top-3 right-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/390/390973.png" alt="check_icon">
                            </div>
                        </li>

                        <li class="relative">
                            <input @click="hideInput" class="sr-only peer" type="radio" value="no" name="answer" id="answer_no" v-model="data.answer">
                            <label class="py-2 pl-6 pr-14 flex bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-red-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:shadow-lg" for="answer_no">
                                ไม่เข้าร่วมงาน
                            </label>
                            <div class="absolute hidden w-5 h-5 peer-checked:block top-3 right-5">
                                <img src="https://cdn-icons-png.flaticon.com/512/594/594864.png" alt="cancel_icon">
                            </div>
                        </li>
                    </ul>
                    <div id="email_container" class="hidden mt-4">
                        <label for="email">อีเมล: </label>
                        <input v-model="data.email" type="email" name="email" id="email" class="pl-2 shadow border rounded-lg py-1" placeholder="example@ku.th">
                        <p v-if="this.error === 'email_1'" class="text-red-500 ml-4 inline">กรุณากรอกอีเมล</p>
                        <p v-if="this.error === 'email_2'" class="text-red-500 ml-4 inline">อีเมลนี้ถูกใช้ไปแล้ว</p>
                    </div>
                    <div class="flex items-center space-x-2 rounded-b mt-4">
                        <button data-modal-toggle="defaultModal" type="button" class="text-gray-700 p-2 px-4 shadow rounded-lg bg-[#f2f0f0] hover:bg-gray-200">ยกเลิก</button>
                        <button @click="submitForm" type="button" class="text-white p-2 px-4 shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]">ตกลง</button>
                    </div>
                    <input type="text" class="hidden" name="id" value="employee_id">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            data: {
                employee_id: parseInt(this.employee_id),
                answer: '',
                email: '',
            },
            error: null,
            finish: true,
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
    },
    methods: {
        showInput() {
            document.getElementById('email_container').style.display = "block";
        },
        hideInput() {
            document.getElementById('email_container').style.display = "none";
        },
        async submitForm() {
            try {
                this.finish = false
                const response = await axios.post(this.url , this.data)
                this.error = "201"
                this.finish = true;
            } catch (e) {
                if (this.data.answer === '')
                    this.error = "answer"
                else if (this.data.email === '')
                    this.error = "email_1"
                else
                    this.error = "email_2"
            }
        },
        clear() {
            this.data.answer = '';
            this.data.email = '';
            this.error = null;
            this.finish = true;
        }
    },
    mounted() {
        console.log(this.employee)
    }
}
</script>
