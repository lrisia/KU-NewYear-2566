<template>
    <div class="main">
        <div class="flex items-center justify-center w-full my-8" @dragover="dragover" @dragleave="dragleave" @drop="drop">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-80 border-2 border-gray-400 border-dashed rounded-lg cursor-pointer bg-gray-100"
                :class="{ 'bg-gray-200': isDragging }">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-20 h-20 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-gray-500"><span class="font-semibold">คลิกเพื่อเลือกไฟล์</span> หรือวางไฟล์</p>
                    <p class="text-sm text-gray-500">ไฟล์ .csv เท่านั้น</p>
                </div>
                <input id="dropzone-file" type="file" name="upload" class="hidden" @change="onChange" ref="file"
                    accept=".csv" />
            </label>
        </div>
        <div v-if="file" class="md:flex items-center my-6 max-w-full">
            <p class="mr-2 text-sm">ไฟล์ที่เลือก:</p>
            <div
                class="mt-2 md:mt-0 flex items-center p-2.5 px-4 text-sm sm:text-base text-gray-500 bg-gray-200 rounded-lg">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z" />
                    <polyline points="13 2 13 9 20 9" />
                </svg>
                <p class="mx-2 flex text-xs md:text-sm">{{ file.name }}</p>
                <button type="button"
                    class="text-gray-500 bg-transparent hover:bg-gray-300 hover:text-gray-900 rounded text-sm p-1 inline-flex items-center ml-auto"
                    @click="removeFile">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <button @click="uploadFile" :class="{ 'bg-[#B0C03B] hover:bg-[#98a534] shadow': file, 'bg-gray-300': !file }"
            :disabled="!file" class="p-2.5 px-4 text-white text-xs sm:text-sm text-center rounded-lg">
            อัปโหลดไฟล์
        </button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            isDragging: false,
            file: null,
        };
    },
    methods: {
        onChange() {
            this.file = this.$refs.file.files[0];
        },
        dragover(e) {
            e.preventDefault();
            this.isDragging = true;
        },
        dragleave() {
            this.isDragging = false;
        },
        drop(e) {
            e.preventDefault();
            this.isDragging = false;
            const fileType = e.dataTransfer.files[0].type;
            if (fileType === 'text/csv') {
                this.$refs.file.files = e.dataTransfer.files;
                this.onChange();
            } else {
                alert('กรุณาเลือกไฟล์ .csv เท่านั้น');
            }
        },
        removeFile() {
            this.$refs.file.value = null;
            this.file = null;
        },
        async uploadFile() {
            if (this.file) {
                const formData = new FormData();
                formData.append('upload', this.file);
                try {
                    const response = await axios.post('/staff/employees/upload', formData);
                    this.$refs.file.value = null;
                    this.file = null;
                    this.successAlert();
                } catch (e) {
                    console.log(e);
                }
            }
        },
        successAlert() {
            Swal.fire({
                title: 'อัปโหลดไฟล์สำเร็จ',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    timerInterval = setInterval(() => {
                        Swal.getHtmlContainer().querySelector('b')
                            .textContent = (Swal.getTimerLeft() / 1000)
                                .toFixed(0)
                    }, 100)
                }
            }).then(async () => {
                window.open('/staff/employees', '_self');
            });
        },
    },
};
</script>
