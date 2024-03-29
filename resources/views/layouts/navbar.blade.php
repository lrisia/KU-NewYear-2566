<nav class="bg-[#006C67] border-gray-200 px-1 sm:px-2 py-2 sticky top-0 z-20">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{ url('/') }}" class="flex items-center">
        <span class="self-center text-xl font-semibold whitespace-nowrap font-mono text-white ml-1">
            <img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAADgCAMAAAAt85rTAAABF1BMVEUAbGf///+zuh4AbWUAbWexux8Aa20Ca2gAaVqvvB4AaWombjy1uxqowT0AcmsHaG7/+//r///8//tHhDYyd3j//Pr5//+lwzwIal4Ac2QAYluVvbrz//8AaGGdysdFhYVnlZgAXFu/3t1olUIAaVWdwEOvvS0AZGYmdD8AW1QEZGlim0QAWl/j///3//sAWFQAcXDb9Pdol5VPkYoAXVADcnUAUEg3eHTN8fSIubxuoaDY/v2v0tNHb2Y2enDP6Ok2b3aKqaklZF5DgX70/fH17Oyf09GryspUj49fnZ13oKGLw8BniYSTragrbW3P4eBMfYAATlC96umDuLDA3tZxuLEAa3Qdb0mQxmFfm1kndDigv0k+h01IA1NoAAAO7klEQVR4nO2dj1fbthbH7Uq1qNc6th9WHSOzOo/OTV4SO5SW8OOVtnRA2cZa2Lq9H///3/HudUKHFCcBngNxj77bOT0H/EMfX+nqSroShqGlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpVWZmA1q2EyS4RA66x7DIISwOaIUHnSN9xclKLl7VgluIEqI4zhY4K8ybGZQY2bpKJmvkADi/PfDo6ghvZ+Mfl4Nn0GaheQX4EedXjZKKLPTjlyoMkAy5zMVDwtByvtBtDIL2mmaQgVpXBFrAgCb/nz4DWOW1ZilTqcRE6jocwHhW+L70yv3phQqVVUGpPkreCIr2sGlWDMks15RNFLHke5RZVkWtKNrAFInz6G2SDczA77NdRrwtQgpS6MojCWFTWdG84FSR+3X7Xi2oqTLjPmApElYqtya2hQ+b0WAbHvPU9U7CR3WKXsBtgxm5Mn2+kBM3KZouHMWzS9mtN4TQnnWTsLQEVQDmK56gWn65lXxZ6lB7bKrCw9kdXd7pirOTdd1r/7E572TKLfmAsKFrvz+tYgZTVZagNsBujJgAIC0FBArHLOTj72+H8h8gW8GLpd+5Ptib3uGr5oFaN0XIPqO5HCSz4QfcNGXCH0/4PttUi9AIEzfD6Hok4B87Z+eYkGwaVwvQAqAWUsUfHJ97Iv9129kQCB0ze/jWgFCAJqsieJi3pfKJA6S5htPcjIuFyb/fr4XXTCgXQ4IKPJ1jELPYdH2hSe3P9fs94NADN+mRLUg54H4fl4x78uCJJQBocd2GER1Jz1eAsi91W4eK4A+NwEwrQcgxDs2VNDobE8Evtz64PrA20ysXLVgvQCJ3WE0jM6F6/bl1gf9u7hoUxhC1hnQIHbDoq/3PR4oFuTcFUcZI9SpdRU1CLPy7B3nfd83JV8JIVorYl8ggqs1II2pkz4T6FF8OeLkovc+zi24Ot6uJWAx3qE0duK3A8W7uOBeOPcOU4sRCyrxqic9ZkkAp/WDVyyIA1xqpEOonzIhtkfxLLGADhiXFPAaVbSYZ0v2hflBBgD1vXefX+U1B2RImO0IJJLKgXzrXSvPWZ0BcXbTtpNdzw0UPpA4T1LmwBW03oAsXd3jP/p92X+CBh07J2HMWF5fQGJAjPZ+YMoXcGAN+N6nlOE0DTTR+gKCWNQSsuUKQN971v1aiPoCMqPZXuNKDwgjigAcKDTAy/nn5QWc1w+yPNw1lQLgbITvHX1ODbr8gHMtGL30XKUAcH3gHSU2qz0gLvuAg4ESyIAQwQw7DYvRrxO79QMkLDRsK2ftFnf5VUBoj3DDYDW1igWougJSajeNxqs8OeaKh+Hc/+CKk0h+TB0BaTEEVGZzR0UX79rKjHUdAS2LRZvCVwyICxBivU2UNe46AjYsY7tnSlNo2MEDXyujxJCnrJcXcEo/iIAsGnI5wEZALg46jNpMNuHyAk6xoEFhCHEklCk0XCITvX+mTt6xawxois0UGmC2BvZTViD8H11PdaC1BIxzXAXkE5O8nIvTpGy5oV6AfLNJktU94aqALu/9lFmv6g7oAmD4fihcN1D7CH4UUatsVbpWgGDBsN0SOOZTJwpFFjt5vapoSTcBgK/XPBMXaJWBrlmEaPUCLHUyP++KIr5WB7o+HySkdGm0ZoC/9FTTjctsip2tbwDQ9TyuTqAVgo6+x0ozLWsFCOEYV5MMxoAwNtxvO3UHNF2MQCdmeQvA4JuIZCAkC4IyQBOCN3eY1B7Qnw7Y912xg10Fq8t4sKwfnCNxFju1Hi7NE9/PHIPVZcB7C0BTHMZqwuq3BWgetInDvmFAn59Ghv3tAvof3EEnz2sP6GJ3AR7lV64ufPo+P/6coxv9CllHQMxT7ouD14eeqSQrw0Df+8TI1Z0tyws4vR+EyDoQw7N460goq/MQBIjzz6M9MnVcm/gL0OwdpnmsTv8WuVxiN8JdR7UG5Nwrsnzax+rgCSJSPmAsdmoNaHLvIrG+WA7JlPEvx1jV2+le2UFXR0BXrGc25oc47Xdy0Tmu0XPvLDa+blIrBXSXGtA3W0nDpoQxEmZD7DDUIfBvW7QxC9BcYkDXDczBWWrZpACMNoU5MYfIxWZEbbuOgEGANfBt59UIkDZJ1uITgH130CYsXXbA0n4QenjvGabZ2dRhNnMI++RNXATIa1vs/7egex9VlHu7XfAuCGekNqOse8zVMT6Y1Ht7GcpMAzyZB9i+nzbI15MGDUOW2gAIhJbV8dSLXL/Pf83GU2yWQUsBd+cC7t/99jpwH63PhrzF1Up2+I9yxq8r+gHfjDGd0s4NQtK3csqej6ulu2mRL1w2lcoMBqPm9r6A1199MOdrGS2ywBcHePCeyQN2ZhnRwFUCtn4/cIeRgbt5EdBulADuzADEn8ev9/gE4E5C8xm7wCsA3IyIncrjPQO6CnlTncsB0NtpO6TYVkzszlCtom7/uDsVEJo2hOtxbxJwFwBZVdvMS9cHX644trSHF0vZPp/IOXRd3mPUsUaA3QPpggABDz7PAES+l14xTakA4rTkYgGNhrzMSZnFXsr7IsY0+1nRXqDD7O6rgIHfW50JSKFp+9ApSc/FLWusfAmkMsDQbuQSH7EaeftIDdYgKHWhJ2gwYsQkT9aUXwOg2I3BulMB4+45pp7KFvRwXz8LqzoJobQN2oxJgAZh0NDynutK1QkT88yDBMoDRmTJplAiVhj6tzIjb1hl6zXwSMZWcTsiv3wk7hty+UGGrWOBFizbAYqnUthQn9yg78ubyX3+LgIEi9G4i4BC2du0Hb/6Ug4IzSBbV/Y1Q7MWx9G0Wr1IQHgns6OhqfQV+NEHZyy3scJlQwxv5NExb7WNfMpm89x44wXK07DvvA/A0f6QaNdTMxN43+XHGW6dcJoRDP1dNbUGxhzlx2IwwwHHrH4v1+2dTfVLiwUcdRXCdVVX44pPEK0aGJIXqTVKfqm3HTll3TYzti6Eul/dD/h5ch+ARQGpzV72JgD74Ge6xGDYEw65CghdwMFZVLopv/0Rv4cKKE6nBz8VAhLlNJLRJjsbQkdTyd92wet4pxFBGyc7IlCSh3C/4flhkf41Ok2pCBrAacXtC/hYrpLtEPhe174TwLAsFoSY80zI3TLycu5FxLHtkJzhKR7KkRbwg95uBo7D+mKhqzJYI6c0O9sXQq3seDrET0mjIrRxmW8EyJzkmE9OknK+noHNQ5KtCzU9A/MZPG/4LGnHMEZA2UbU3l4biP5EtjS45N4bNu8Ak5vpRhZkzInPvMkMEzDhp+Ikpni7J5SVDF5kbQgxXN8kr7MkSz4nby6O9gR2KJOZHGK9TfOSN98RIHqS6FSUFAzCD0Igomv/1OOTgO7IzNwbtFoHPU8IMSVRRewxGH/dHyBuRTOSYQmgL04jB/fiJXvqRq7xv4gZYHKDj3NaE7stR/J+h7Y67wCTBQI2jY7txCcFoGynD+bAhq7CYemJcqJFURN9BPShzXFUwViCZ5qtLUfN37hTQDxoiRpJSwS+HJGie19LbKcJlXTNLG9ek7l90q/ApHywGlV3mNNtAEdi22WAwltlaEOcQ51BMg3QDALhPUuYo/bA9wBI2+t8IsSCcUQrKmZnYnogzIkQZY58KIS3k9jFsXuVAt6oHxwDkvcDNWDrQwnFxxUnTy0Wvd/jtwAUOxmeNVfVOPBSt7Gg04aBoZorG7h8b6vpsE4aR6tDwW8I2Ic2DO2bVneo4e0Bme20hwqA62OYtbbVxD3NVnp27t2sGXJvJ6PjQxsXDmgWo4kZgIziHKIMiCZ0xVnosJhYVvR+X5hTfKlqu+Ldvc2smEWkRtWA9jZOuMul5ZvMtqd7a0rsNGv1y0KR/XbeSBm4ijjb8XgBOOr3ptgNfxmA+Q5Wk2LqsVK0S8BeH97CrwgBrVnxBLXt6I3Xl27Cky18XGxpNBgWNc62zznGLoWmWBJvcQOxd7GFn7Nq240BV3u+OSrepUxzE+fiZwBCd791xLHw/f7VOwN/mKYWnm3hxIB4OoDureQQtnGtxr34wO7tb0eVHpkqq1O0QXlOXmyy2REhM3BUYboTK6c+9GWWNTrXltGVlYsBZkG7E2dEXALCKOPoEMeK41NhFwPIVYnNOSf8golY9xdP4DBofMtIfdFzyPgAYkaaza1s93zKFoXiMKHh+jZOgjKb0ur956is1ur5b60W/H9VL/Hw5OlOBlydY31pH7Um9Wvr9zAGX2iDl8KpRqioq+8ORBmj2Nv/GGX2eLf6wtogY8mEonkHEk67EcX++jKMja9LP66d76EzA1Pjfx6Y7uJQvnhRKjsh+/Z3ltxfzImnAHN2eLJ5+m7n9PTZz9txlhRnJy8czzBGwRG9OV8ZoTHZkmix8sJeWZaNB0J3up00RX+S54urlZJoiW5/5+T942Oz8dBmNpo8ZiwMQ+zTR99jEVAlxVzYw+jl2eTGZShNirPDw7CaV15XFbXBkssQadyN539dRUbHqN9FK7ytjym9c8r9aDZDeQU1xlVWS0tLq9ZCF05mxF33oOIwqcr48A9L3DeRKhIS1qiqA2G2ZTUsZyk0DoktzIGqim9lA9QkM/++yZ3JwhQnTDnCGYHK/mpPuBISJ1wKFV97YwMHkqSiVC765UsDRjGNWX+/5Q7VQaUrIasuGS/c+OO7ZdPGSmxXlvEbvvjz6dPnz58ukZ7/a8OIrarWQeMXzx8+fLQswpL88MPfN1g8c+b5JgpfPH/8GJ68HHqAH3sBgA8fPV4KPXgAZXm4EMAHS6IFAS5RFX20iCoKj71vsq8aAVJmVRXJFBZ8sDRVFAihioYbdj5jifkbAayGb0kBmxqw5oCVV9GH9w12qSsWrMjJrPz7+SiGWA49xm7iH9APlp6geBuBBR89Lp67BBpF/QgYTttMcmPFCHjPXIqqBSza4FLpYcUW/O4/0LSXyYtWbEH2x59Pnjx5+mRJVIzoqwXc+O/flk0vQnatPxR+TcU4W7eyTKp0UdT6gtOtxvwZvTtUlXxG8VergXOZVCngNf6w/J2rUsBR3ge9byZJlQIyu1hdqvSZWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpaWlpay6P/AZ7S0L0xq3EVAAAAAElFTkSuQmCC"
                alt="" style="width: 60px">
        </span>
            <h1 class="text-lg font-bold text-white ml-6 md:text-xl">ระบบลงทะเบียนเข้าร่วมงานขอบคุณบุคลากร ประจำปี
                2566</h1>
        </a>
        @auth()
            <div class="flex gap-4 items-center">
                <button id="multiLevelDropdownButton" data-dropdown-toggle="dropdown"
                        class="text-white hover:bg-[#0f5653] rounded-lg px-3 py-2.5 text-center inline-flex items-center"
                        type="button">
                    <p class="mr-2">{{ Auth::user()->name }}</p>
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                @if (Auth::user()->isStaff())
                    <div id="dropdown" class="hidden z-10 w-40 bg-white rounded-lg divide-y divide-gray-100 shadow">
                        <ul class="text-sm" aria-labelledby="multiLevelDropdownButton">
                            <li>
                                <a href="/" class="block rounded-t-lg p-2.5 hover:bg-[#e7e6e6]">หน้าหลัก</a>
                            </li>
                            <li>
                                <a href="{{ route('staff.organizers') }}" class="block p-2.5 hover:bg-[#e7e6e6]">หน่วยงานทั้งหมด</a>
                            </li>
                            <li>
                                <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                                        data-dropdown-placement="right-start" type="button"
                                        class="flex justify-between items-center p-2.5 w-full hover:bg-[#e7e6e6]">รางวัล
                                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div id="doubleDropdown"
                                     class="hidden z-10 w-40 bg-white rounded-lg divide-y divide-gray-100 shadow">
                                    <ul class="text-sm" aria-labelledby="doubleDropdownButton">
                                        <li>
                                            <a class="block p-2.5 rounded-t-lg hover:bg-[#e7e6e6]" href="{{ route('staff.prizes') }}">รางวัลทั้งหมด</a>
                                        </li>
                                        <li>
                                            <a class="block p-2.5 hover:bg-[#e7e6e6]" href="{{ route('staff.prizes.search') }}">ค้นหาชื่อผู้ได้รับรางวัล</a>
                                        </li>
{{--                                        <li>--}}
{{--                                            <a class="block p-2.5 hover:bg-[#e7e6e6]" href="{{ route('lucky-draw.button') }}">ปุ่มจับรางวัล</a>--}}
{{--                                        </li>--}}
                                        <li>
                                            <a class="block rounded-b-lg p-2.5 hover:bg-[#e7e6e6]"
                                               href="{{ route('lucky-draw.draw') }}">แสดงผลการจับรางวัล</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <button id="doubleDropdownButton2" data-dropdown-toggle="doubleDropdown2"
                                        data-dropdown-placement="right-start" type="button"
                                        class="flex justify-between items-center p-2.5 w-full hover:bg-[#e7e6e6]">
                                    รายชื่อบุคลากร
                                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div id="doubleDropdown2"
                                     class="hidden z-10 w-40 bg-white rounded-lg divide-y divide-gray-100 shadow">
                                    <ul class="text-sm" aria-labelledby="doubleDropdownButton2">
                                        <li>
                                            <a class="block rounded-t-lg p-2.5 hover:bg-[#e7e6e6]"
                                               href="{{ route('staff.employees') }}">รายชื่อบุคลากรทั้งหมด</a>
                                        </li>
                                        <li>
                                            <a class="block p-2.5 hover:bg-[#e7e6e6]"
                                               href="{{ route('staff.employees.registered') }}">รายชื่อผู้ที่ลงทะเบียนแล้ว</a>
                                        </li>
                                        <li>
                                            <a class="block p-2.5 hover:bg-[#e7e6e6]" href="{{ route('staff.employees.attended') }}">รายชื่อผู้เข้าร่วมงาน</a>
                                        </li>
                                        <li>
                                            <a class="block rounded-b-lg p-2.5 hover:bg-[#e7e6e6]"
                                               href="{{ route('staff.employees.upload.show') }}">เพิ่มรายชื่อบุคลากร</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('qr-code.scan') }}" class="block p-2.5 rounded-b-lg hover:bg-[#e7e6e6]">สแกน QR Code</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div id="dropdown" class="hidden z-10 w-40 bg-white rounded-lg divide-y divide-gray-100 shadow">
                        <ul class="text-sm" aria-labelledby="multiLevelDropdownButton">
                            <li>
                                <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                                        data-dropdown-placement="right-start" type="button"
                                        class="flex justify-between items-center p-2.5 w-full hover:bg-[#e7e6e6] rounded-t-lg rounded-b-lg">รางวัล
                                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div id="doubleDropdown"
                                     class="hidden z-10 w-40 bg-white rounded-lg divide-y divide-gray-100 shadow">
                                    <ul class="text-sm" aria-labelledby="doubleDropdownButton">
                                        <li>
                                            <a class="block p-2.5 rounded-t-lg rounded-b-lg hover:bg-[#e7e6e6]" href="{{ route('staff.prizes') }}">รางวัลทั้งหมด</a>
                                        </li>
{{--                                        <li>--}}
{{--                                            <a class="block p-2.5 hover:bg-[#e7e6e6]" href="{{ route('staff.prizes.search') }}">ค้นหาชื่อผู้ได้รับรางวัล</a>--}}
{{--                                        </li>--}}
                                        {{--                                        <li>--}}
                                        {{--                                            <a class="block p-2.5 hover:bg-[#e7e6e6]" href="{{ route('lucky-draw.button') }}">ปุ่มจับรางวัล</a>--}}
                                        {{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a class="block rounded-b-lg p-2.5 hover:bg-[#e7e6e6]"--}}
{{--                                               href="{{ route('lucky-draw.draw') }}">แสดงผลการจับรางวัล</a>--}}
{{--                                        </li>--}}
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button :href="route('logout')"
                            onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                            class="text-white hover:underline  hover:bg-[#0f5653] rounded-lg px-4 py-2.5">
                        <span class="material-symbols-outlined">ออกจากระบบ</span>
                    </button>
                </form>
            </div>

        @endauth
    </div>
</nav>
