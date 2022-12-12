<template>
    <div class="fixed bg-gray-200 p-3 rounded-lg left-5 mt-5 cursor-pointer" @click="toggle">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 fill-black">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
    </div>

    <div id="sideBar" class="h-full fixed left-0 bg-gray-200 overflow-hidden w-[0vw] ease-in-out duration-500 z-10">
        <div class="ml-1.5 mt-1.5"><a href="javascript:void(0)" @click="toggle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 absolute right-3 top-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a></div>
        <div class="grid grid-cols-1 gap-3 ml-5 mt-3 whitespace-nowrap">
            <p><a href="/">หน้าหลัก</a></p>
            <p><a v-bind:href="url + '/registered'">ตรวจสอบคนที่ลงทะเบียนแล้ว</a></p>
            <p><a v-bind:href="url + '/organizers'">ตรวจสอบแบ่งตามองค์กร</a></p>
            <p><a href="#">Clients</a></p>
            <p><a href="#">Contact</a></p>
        </div>

    </div>
</template>

<style>
    #sideBar a:hover {
        color: #ff0000;
    }
    #sideBar a {
        color: #000000;
    }
</style>

<script>
export default {
    data() {
        return {
            sideBarToggle: false
        }
    },
    methods: {
        toggle() {
            if (this.sideBarToggle) {
                document.getElementById("sideBar").style.width = "0vw";
            } else {
                document.getElementById("sideBar").style.width = "15vw";
            }
            this.sideBarToggle = !this.sideBarToggle
        }
    },
    props: {
        url: {
            type: String,
            required: true
        }
    }
}
</script>
