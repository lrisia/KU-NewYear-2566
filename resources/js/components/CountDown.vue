<template>
    <div class="max-w-7xl mx-auto mt-8 p-8 rounded-lg bg-[#D9D9D9]">
      <div class="text-center text-lg md:text-xl">เหลือเวลาลงทะเบียนอีก</div>
      <div class="lg:mx-auto xl:mx-52">
        <div class="mt-6 md:mt-10 grid grid-cols-4 gap-3 justify-center">
          <div class="flex items-center flex-col flex-nowrap">
            <span class="w-14 h-16 sm:w-20 sm:h-20 md:w-36 md:h-32 bg-white shadow-xl mx-auto flex items-center justify-center mb-5 rounded-lg text-3xl md:text-6xl"
              id="days"></span>
            <span class="title md:text-lg">วัน</span>
          </div>
          <div class="flex items-center flex-col flex-nowrap">
            <span class="w-14 h-16 sm:w-20 sm:h-20 md:w-36 md:h-32 bg-white shadow-xl mx-auto flex items-center justify-center mb-5 rounded-lg text-3xl md:text-6xl"
              id="hours"></span>
            <span class="title md:text-lg">ชั่วโมง</span>
          </div>
          <div class="flex items-center flex-col flex-nowrap">
            <span class="w-14 h-16 sm:w-20 sm:h-20 md:w-36 md:h-32 bg-white shadow-xl mx-auto flex items-center justify-center mb-5 rounded-lg text-3xl md:text-6xl"
              id="minutes"></span>
            <span class="title md:text-lg">นาที</span>
          </div>
          <div class="flex items-center flex-col flex-nowrap">
            <span class="w-14 h-16 sm:w-20 sm:h-20 md:w-36 md:h-32 bg-white shadow-xl mx-auto flex items-center justify-center mb-5 rounded-lg text-3xl md:text-6xl"
            id="seconds"></span>
            <span class="title md:text-lg">วินาที</span>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  window.addEventListener("load", () => {
    const HOURS = 1000 * 60 * 60;
    const MINUTES = 1000 * 60;
    const daysElement = document.getElementById("days");
    const hoursElement = document.getElementById("hours");
    const minutesElement = document.getElementById("minutes");
    const secondsElement = document.getElementById("seconds");
    const date = new Date("2022-12-31 00:00:00");
    const timerEndDate = new Date(date.getTime());

    const updateTimer = () => {
        const currentTime = new Date().getTime();
        const difference = timerEndDate.getTime() - currentTime;
        const remainingDays = Math.floor(difference / (HOURS * 24));
        const remainingHours = Math.floor((difference % (HOURS * 24)) / HOURS);
        const remainingMinutes = Math.floor((difference % HOURS) / MINUTES);
        const remainingSeconds = Math.floor((difference % MINUTES) / 1000);
        const formattedDays = remainingDays < 10 ? `0${remainingDays}` : `${remainingDays}`;
        const formattedHours = remainingHours < 10 ? `0${remainingHours}` : `${remainingHours}`;
        const formattedMinutes = remainingMinutes < 10 ? `0${remainingMinutes}` : `${remainingMinutes}`;
        const formattedSeconds = remainingSeconds < 10 ? `0${remainingSeconds}` : `${remainingSeconds}`;
        if (timerEndDate < currentTime) {
          daysElement.innerText = '00';
          hoursElement.innerText = '00';
          minutesElement.innerText = '00';
          secondsElement.innerText = '00';
        }
        else {
          daysElement.innerText = formattedDays;
          hoursElement.innerText = formattedHours;
          minutesElement.innerText = formattedMinutes;
          secondsElement.innerText = formattedSeconds;
        }
    };
    updateTimer();
    setInterval(updateTimer, 1000);
  });
</script>
