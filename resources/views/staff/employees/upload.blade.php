@extends('layouts.main')

@section('content')
<section class="min-h-screen mx-auto">
    <div class="mx-8">
        <div>
            <h1 class="md:text-lg mt-10">
                เพิ่มรายชื่อบุคลากรรายบุคคล
            </h1>
            <form class="mt-8">
                <div class="grid gap-6 mb-8 md:grid-cols-2">
                    <div>
                        <label for="p_id" class="block mb-2 text-sm font-medium text-gray-900">รหัสพนักงาน</label>
                        <input type="text" name="p_id" id="p_id" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" pattern="[0-9]+" placeholder="เช่น 12345678" required>
                    </div>
                    <div>
                        <label for="pre_t" class="block mb-2 text-sm font-medium text-gray-900">คำนำหน้าชื่อ</label>
                        <select name="pre_t" id="pre_t" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div>
                        <label for="tname" class="block mb-2 text-sm font-medium text-gray-900">ชื่อ</label>
                        <input type="text" name="tname" id="tname" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="กรอกชื่อ" required>
                    </div>
                    <div>
                        <label for="tsurname" class="block mb-2 text-sm font-medium text-gray-900">นามสกุล</label>
                        <input type="text" name="tsurname" id="tsurname" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="กรอกนามสกุล" required>
                    </div>
                    <div>
                        <label for="fac" class="block mb-2 text-sm font-medium text-gray-900">รหัสหน่วยงาน</label>
                        <input type="text" name="fac" id="fac" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" pattern="[A-Z][0-9]+" placeholder="เช่น B02" required>
                    </div>  
                    <div>
                        <label for="t_facname" class="block mb-2 text-sm font-medium text-gray-900">ชื่อหน่วยงาน</label>
                        <input type="text" name="t_facname" id="t_facname" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="เช่น คณะเกษตร หรือ สำนักงานมหาวิทยาลัย" required>
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
                เพิ่มรายชื่อบุคลากรด้วยไฟล์ .csv <p class="text-xs md:text-sm text-gray-500 mt-1">*ดาวน์โหลดไฟล์ตัวอย่างและแก้ไขข้อมูลตั้งแต่แถวที่ 2 เป็นต้นไป</p>
            </h1>
            <a href="/template/employee-data.csv" class="bg-gray-500 hover:bg-gray-600 p-2.5 px-4 text-white text-xs sm:text-sm text-center rounded-lg ml-auto" download>
                ดาวน์โหลดไฟล์ตัวอย่าง
            </a>
        </div>
        
        <upload-employee-file></upload-employee-file>
    </div>
</section>
@endsection
