<template>
    <div class="relative max-w-full mt-10">
        <img src="/image/register_cover_2566.png" style="width:100%;">
        <div class="absolute top-1/2 bottom-1/2 max-w-7xl" style="width:100%;">
            <div class="text-center text-xs mobile:text-xs sm:text-xl md:text-2xl">เหลือเวลาลงทะเบียนอีก</div>
            <div class="lg:mx-auto xl:mx-52">
                <div class="mt-2 mobile:mt-1 sm:mt-2 md:mt-4 lg:mt-10 grid grid-cols-4 gap-1 items-center justify-center px-10 mobile:px-10 sm:px-12 lg:px-20" style="width:100%;">
                    <div class="flex items-center flex-col flex-nowrap">
                        <span class="w-8 h-8 mobile:w-8 mobile:h-8 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-32 lg:h-32 mobile:text-xl sm:text-2xl md:text-4xl lg:text-6xl bg-white shadow-2xl flex items-center justify-center rounded-lg"
                        id="days">{{ days }}</span>
                        <span class="text-xs mt-1 mobile:mt-1 sm:mt-2 md:mt-3 lg:mt-5 mobile:text-xs sm:text-lg md:text-xl lg:text-2xl">วัน</span>
                    </div>
                    <div class="flex items-center flex-col flex-nowrap">
                        <span class="w-8 h-8 mobile:w-8 mobile:h-8 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-32 lg:h-32 mobile:text-xl sm:text-2xl md:text-4xl lg:text-6xl bg-white shadow-2xl flex items-center justify-center rounded-lg"
                        id="hours">{{ hours }}</span>
                        <span class="text-xs mt-1 mobile:mt-1 sm:mt-2 md:mt-3 lg:mt-5 mobile:text-xs sm:text-lg md:text-xl lg:text-2xl">ชั่วโมง</span>
                    </div>
                    <div class="flex items-center flex-col flex-nowrap">
                        <span class="w-8 h-8 mobile:w-8 mobile:h-8 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-32 lg:h-32 mobile:text-xl sm:text-2xl md:text-4xl lg:text-6xl bg-white shadow-2xl flex items-center justify-center rounded-lg"
                        id="minutes">{{ minutes }}</span>
                        <span class="text-xs mt-1 mobile:mt-1 sm:mt-2 md:mt-3 lg:mt-5 mobile:text-xs sm:text-lg md:text-xl lg:text-2xl">นาที</span>
                    </div>
                    <div class="flex items-center flex-col flex-nowrap">
                        <span class="w-8 h-8 mobile:w-8 mobile:h-8 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-32 lg:h-32 mobile:text-xl sm:text-2xl md:text-4xl lg:text-6xl bg-white shadow-2xl flex items-center justify-center rounded-lg"
                        id="seconds">{{ seconds }}</span>
                        <span class="text-xs mt-1 mobile:mt-1 sm:mt-2 md:mt-3 lg:mt-5 mobile:text-xs sm:text-lg md:text-xl lg:text-2xl">วินาที</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        date: null
    },
    data () {
        return {
            now: Math.trunc((new Date()).getTime() / 1000),
            event: new Date('2023-12-21T00:00:00'),
            finish: false
        }
    },
    mounted () {
        const _self = this
        window.setInterval(() => {
            this.now = Math.trunc((new Date()).getTime() / 1000)
            if (!this.finish && this.calculatedDate - this.now <= 0) {
                _self.finish = true
                _self.$emit('onFinish')
            }
        }, 1000)
    },
    computed: {
        secondCount () {
            return this.calculatedDate - this.now
        },
        calculatedDate () {
            return Math.trunc(Date.parse(this.event) / 1000)
        },
        seconds () {
            if (this.secondCount < 0) return 0
            return this.twoDigits(this.secondCount % 60)
        },
        minutes () {
            if (this.secondCount < 0) return 0
            return this.twoDigits(Math.trunc(this.secondCount / 60) % 60)
        },
        hours () {
            if (this.secondCount < 0) return 0
            return this.twoDigits(Math.trunc(this.secondCount / 60 / 60) % 24)
        },
        days () {
            if (this.secondCount < 0) return 0
            return this.twoDigits(Math.trunc(this.secondCount / 60 / 60 / 24))
        }
    },
    methods: {
        twoDigits (value) {
            if (value.toString().length <= 1) {
                return '0' + value.toString()
            }
            return value.toString()
        }
    },
    filters: {
        twoDigits (value) {
            if (value.toString().length <= 1) {
                return '0' + value.toString()
            }
            return value.toString()
        }
    }
}
</script>
