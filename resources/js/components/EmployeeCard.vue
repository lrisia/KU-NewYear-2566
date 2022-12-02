<template>
    <div class="block w-full p-3 py-4 my-4 text-sm text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-white md:text-base md:p-3 md:py-6" >
        <div class="grid grid-cols-3 gap-3 mobile:text-xs content-start">
            <p class="my-2 ml-4 break-words">{{ employee.name }}</p>
            <p class="my-2 break-words">{{ organizer_name }}</p>
            <div class="relative">
                <span class="absolute right-2">
                    <register-popup :employee="employee" :organizer_name="organizer_name" :url="url">
                    </register-popup>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
        }
    },
}
</script>
