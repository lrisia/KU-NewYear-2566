<x-mail::message>
<h1 style="text-align: center"> งานขอบคุณบุคลากร </h1>

<p style="text-align: center">ชื่อ - นามสกุล: {{ $employee->name }}</p>

<p style="text-align: center">หน่วยงาน: {{ $employee->organizer->name }}</p>

<div style="text-align: center">
    <a href="{{ url('/qr-code/' . $employee->qr_code) }}">
        QR Code สำหรับเข้าร่วมงานขอบคุณบุคลากร
    </a>
</div>

</x-mail::message>
