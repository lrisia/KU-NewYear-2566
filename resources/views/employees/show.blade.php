@extends('layouts.main')

@section('content')
<div class="w-full">
<section class="mt-10 w-full" id="printThis">
  <div class="mx-10 justify-center">
    <h1 class="text-center text-xl md:text-2xl font-bold my-10">ระบบได้บันทึกการลงทะเบียนร่วมงานเรียบร้อยแล้ว</h1>
    <p class="text-center text-lg md:text-xl font-bold my-4">{{ $employee->name }}</p>
    <p class="text-center text-lg md:text-xl font-bold my-4">{{ $organizer_name }}</p>
    <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate($employee->qr_code)) !!} " class="mx-auto my-10 w-40 md:w-56">
    <h1 class="text-center text-lg md:text-xl font-bold mt-10 mb-4">โปรดนำ QR Code มาแสดงที่หน้างาน เพื่อใช้ยืนยันการเข้าร่วมงานและได้รับสิทธิ์ลุ้นรางวัล</h1>
    <p class="text-center md:text-lg my-6">ระบบได้ส่งอีเมลยืนยันการเข้าร่วมให้ท่านเรียบร้อยแล้ว ท่านสามารถเข้าหน้านี้ได้จากอีเมล</p>
  </div>
</section>
<div class="flex items-end justify-center space-x-3 my-2">
    <button class="px-6 py-2 text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" onclick="printDiv('printThis')">พิมพ์</button>
</div>
</div>

@endsection

@section('script')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection
