<template>
    <div class="max-w-7xl mx-auto mt-8 p-8 rounded-lg bg-[#e7e6e6]">
    <div class="mx-20">
        <div class="mt-6 text-center sm:text-xl md:text-2xl">เหลือเวลารับรางวัลอีก</div>
        <div class="mt-6 md:mt-10 flex gap-5 justify-center">
            <div class="flex items-center flex-col flex-nowrap">
                <span class="w-14 h-16 sm:w-20 sm:h-20 md:w-36 md:h-32 bg-white shadow-xl mx-auto flex items-center justify-center mb-5 rounded-lg text-3xl md:text-6xl"
                id="minutes">{{ minutes }}</span>
                <span class="title md:text-lg">นาที</span>
            </div>
            <div class="flex items-center flex-col flex-nowrap">
                <span class="w-14 h-16 sm:w-20 sm:h-20 md:w-36 md:h-32 bg-white shadow-xl mx-auto flex items-center justify-center mb-5 rounded-lg text-3xl md:text-6xl"
                id="seconds">{{ seconds }}</span>
                <span class="title md:text-lg">วินาที</span>
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
            event: new Date(new Date().getTime() + (15 * 60000)),
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
