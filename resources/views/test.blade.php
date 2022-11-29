@extends('layouts.main')

@section('content')
<section class="mt-10" id="printThis">
  <div class="mx-10 justify-center">    
    <h1 class="text-center text-xl md:text-2xl font-bold my-10">งานขอบคุณบุคลากรประจำปี 2565</h1>
    <p class="text-center text-lg md:text-xl my-4">ชื่อ - นามสกุล</p>
    <p class="text-center text-lg md:text-xl my-4">หน่วยงาน</p>
    <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate('Make me into an QrCode!')) !!} " class="mx-auto my-10 w-40 md:w-56">
    <h1 class="text-center text-lg md:text-xl font-bold my-10">โปรดบันทึก QR Code สำหรับใช้เข้าร่วมงาน</h1>
  </div>
</section>
<div class="flex items-end justify-center space-x-3 my-2">
    <button class="px-6 py-2 text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" onclick="printDiv('printThis')">พิมพ์</button>
</div>

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
