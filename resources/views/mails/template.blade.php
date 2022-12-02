<x-mail::message>
<h1 style="text-align: center"> งานขอบคุณบุคลากร ประจำปี 2565 </h1>

เรียนคุณ {{ $employee->name }} {{ $employee->organizer->name }}

ระบบได้บันทึกการลงทะเบียนร่วมงานขอบคุณบุคลากรเรียบร้อยแล้ว โปรดนำ QR Code มาแสดงที่หน้างาน เพื่อใช้ยืนยันการเข้าร่วมงานและได้รับสิทธิ์ลุ้นรางวัล โดยเข้าดู QR Code ได้ที่ลิงก์นี้

<x-mail::button :url="url('/qr-code/' . $employee->qr_code)">
QR Code สำหรับเข้าร่วมงานขอบคุณบุคลากร ประจำปี 2565
</x-mail::button>

ขอแสดงความนับถือ

มหาวิทยาลัยเกษตรศาสตร์ บางเขน

<span style="color:red">อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบอัตโนมัติ กรุณาอย่าตอบกลับ</span>

</x-mail::message>
