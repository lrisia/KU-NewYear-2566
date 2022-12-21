@extends('layouts.main')

@section('content')
    <div class="w-full">
        <div class="relative flex items-end justify-end mx-8 mt-4">
            <button class="absolute top-3 px-6 py-2 text-white mobile:text-sm  shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" onclick="printDiv('printThis')">
                พิมพ์รายชื่อ
            </button>
        </div>
        <section class="w-full" id="printThis">
            <div class="mx-8">
                <h1 class="text-base sm:text-lg lg:text-xl mt-6">
                    รายชื่อผู้ได้รับรางวัล
                </h1>
                <p class="mobile:text-sm sm:text-base lg:text-lg mt-6">
                    <span class="mr-2">รางวัลที่ {{ $prize->prize_no }}</span>
                    <span class="mr-2">{{ $prize->type }}</span>
                    <span class="mr-2">{{ $prize->description }}</span>
                    <span class="mr-2">จำนวน {{ $prize->total_amount }} รางวัล</span>
                    <span class="mr-2">รับรางวัลแล้วจำนวน {{ $prize->employees->where('took_prize', '=',  1)->count() }} คน</span>
                </p>
                <div class="my-4 overflow-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                    <table class="w-full text-left mr-0">
                        <thead class="bg-[#e7e6e6] border-2 text-sm mobile:text-xs sm:text-base">
                            <tr>
                                <th scope="col" class="py-3 pl-10 pr-4">ลำดับ</th>
                                <th scope="col" class="py-3 px-6">ชื่อ-นามสกุล</th>
                                <th scope="col" class="py-3 px-6">หน่วยงาน</th>
                                <th scope="col" class="py-3 px-6"></th>
                            </tr>
                        </thead>
                        <tbody class="m-2">
                            @foreach($employees as $employee)
                            <tr class="border text-gray-700 text-sm mobile:text-xs sm:text-base">
                                <td class="px-10 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $employee->name }}</td>
                                <td class="px-6 py-4">{{ $employee->organizer->name }}</td>
                                <td class="px-6 py-4">
                                    @if($employee->took_prize != null)
                                        <div class="flex justify-start">
                                            <p class="p-2 text-xs sm:text-sm border border-[#DADADA] text-center text-gray-500 shadow rounded-lg bg-gray-100">รับรางวัลแล้ว</p>    
                                        </div>
                                    @else
                                        <prize-popup :employee="{{ $employee->toJson() }}" organizer_name="{{ $employee->organizer->name }}" prize_no="{{ $employee->prize->prize_no }}" prize_type="{{ $employee->prize->type }}" prize_description="{{ $employee->prize->description }}" url="{{ url("/") }}">
                                        </prize-popup>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

@endsection

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
