<template>

    <!-- Modal toggle -->
    <button class="p-2 px-3 text-white text-xs sm:text-sm text-center shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" @click="onToggle">
        กดรับรางวัล
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
                                    ยืนยันการรับรางวัล
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
                            <div class="modal-body p-5 w-full overflow-y-auto ">
                                <p class="text-sm md:text-base mb-4 leading-relaxed">
                                    รางวัลที่ <span class="text-black mr-2">{{ prize_no }}</span><span class="text-black mr-2">{{ prize_type }}</span><span class="text-black">{{ prize_description }}</span>
                                </p>
                                <p class="text-sm md:text-base mb-4 leading-relaxed">
                                    ชื่อ - นามสกุล: <span class="text-black">{{ employee.name }}</span>
                                </p>
                                <p class="text-sm md:text-base leading-relaxed">
                                    หน่วยงาน: <span class="text-black">{{ organizer_name }}</span>
                                </p>
                            </div>
                            <div class="modal-footer mb-4 px-5">
                                <div class="flex items-center justify-center space-x-2 rounded-b">
                                    <button @click="onToggle"
                                            class="text-gray-500 mr-2 bg-gray-50 hover:bg-gray-200 shadow rounded-lg border border-[#DADADA] px-6 py-2">
                                        ยกเลิก
                                    </button>
                                    <button type="button"
                                            class="text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534] px-8 py-2 flex">
                                        <svg v-if="waiting" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        ยืนยัน
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
export default {
    data() {
        return {
            isOpen: false,
            data: {
                employee_id: parseInt(this.employee.id),
            },
            error: null,
            waiting: false,
        }
    },
    computed: {
        isModalVisible() {
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
        prize_no: {
            type: String,
            required: true,
        },
        prize_type: {
            type: String,
            required: true,
        },
        prize_description: {
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
        }
    }
}
</script>

