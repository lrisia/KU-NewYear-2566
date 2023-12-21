@extends('layouts.main')

@section('content')
<section class="min-h-screen mx-auto">
    <div class="mx-8">
        <div>
            <h1 class="md:text-lg mt-10">
                เพิ่มรายชื่อบุคลากรรายบุคคล
            </h1>
            @if ($success == 1)
                <div
                    class="mt-4 inline-flex w-full items-center rounded-lg bg-green-200 px-6 py-4 text-base text-green-700 border-2 border-green-500"
                    role="alert">
                  <span class="mr-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="h-5 w-5">
                      <path
                          fill-rule="evenodd"
                          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                          clip-rule="evenodd" />
                    </svg>
                  </span>
                    เพิ่มสำเร็จ
                </div>
            @endif
            <form class="mt-8" method="post" action="{{ route('staff.employees.create') }}">
                @csrf
                <div class="grid gap-6 mb-8 md:grid-cols-2">
                    <div>
                        <label for="p_id" class="block mb-2 text-sm font-medium text-gray-900">รหัสพนักงาน<span class="text-red-500"> *</span></label>
                        <input type="text" name="p_id" id="p_id" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" pattern="[0-9]+" placeholder="เช่น 12345678" required>
                    </div>
                    <div>
                        <label for="pre_t" class="block mb-2 text-sm font-medium text-gray-900">คำนำหน้าชื่อ<span class="text-red-500"> *</span></label>
                        <select name="pre_t" id="pre_t" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div>
                        <label for="tname" class="block mb-2 text-sm font-medium text-gray-900">ชื่อ<span class="text-red-500"> *</span></label>
                        <input type="text" name="tname" id="tname" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="กรอกชื่อ" required>
                    </div>
                    <div>
                        <label for="tsurname" class="block mb-2 text-sm font-medium text-gray-900">นามสกุล<span class="text-red-500"> *</span></label>
                        <input type="text" name="tsurname" id="tsurname" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="กรอกนามสกุล" required>
                    </div>
                    <div>
                        <label for="fac" class="block mb-2 text-sm font-medium text-gray-900">รหัสหน่วยงาน<span class="text-red-500"> *</span></label>
                        <input type="text" name="fac" id="fac" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" pattern="[A-Z][0-9]+" placeholder="เช่น B02" required>
                    </div>

                    <div>
                        <label for="t_facname" class="block mb-2 text-sm font-medium text-gray-900">ชื่อหน่วยงาน<span class="text-red-500"> *</span></label>
                        <input type="text" name="t_facname" id="t_facname" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="เช่น คณะเกษตร หรือ สำนักงานมหาวิทยาลัย" required>
                    </div>
                </div>

                <h1 class="md:text-lg mt-10">
                    กรณีเพิ่มรายชื่อพร้อมส่ง QR Code
                </h1>
                <div class="grid gap-6 mb-8 md:grid-cols-2 mt-4">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">อีเมลสำหรับรับ QR Code</label>
                        <input type="text" name="email" id="email" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" placeholder="เช่น example@ku.th">
                    </div>
                    <div>
                        <p class="block mb-2 text-sm font-medium text-gray-900 mb-4">
                            กรณีที่นับถือศาสนาอิสลามและต้องการระบุอาหารฮาลาลโปรดเลือก
                        </p>
                        <input id="islam_yes" name="islam" type="checkbox" value="yes" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                        <label for="islam_yes" class="mb-2 text-sm font-medium text-gray-900 ml-4">อาหารฮาลาล</label>
                    </div>
                </div>

                <button type="submit" class="bg-[#B0C03B] hover:bg-[#98a534] p-2.5 px-4 text-white text-xs sm:text-sm text-center rounded-lg">บันทึกข้อมูล</button>
            </form>
        </div>

        <div class="inline-flex items-center justify-center w-full">
            <hr class="w-full h-px my-8 bg-gray-300 border-0">
            <span class="absolute px-3 font-medium text-gray-400 -translate-x-1/2 bg-white left-1/2">หรือ</span>
        </div>

        <div class="flex items-center justify-items-center">
            <h1 class="md:text-lg mr-2">
                เพิ่มรายชื่อบุคลากรด้วยไฟล์ .csv
                <br>
                <div class="inline-flex">
                    <span class="mr-1 text-gray-500 mt-1">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="h-5 w-5">
                          <path
                              fill-rule="evenodd"
                              d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                              clip-rule="evenodd" />
                        </svg>
                    </span>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">
                        ดาวน์โหลดไฟล์ตัวอย่างและแก้ไขข้อมูลตั้งแต่แถวที่ 2 เป็นต้นไป
                    </p>
                </div>
            </h1>
            <a href="/template/employee-data.csv" class="bg-gray-500 hover:bg-gray-600 p-2.5 px-4 text-white text-xs sm:text-sm text-center rounded-lg ml-auto" download>
                ดาวน์โหลดไฟล์ตัวอย่าง
            </a>
        </div>

        <upload-employee-file></upload-employee-file>
    </div>
</section>
@endsection
