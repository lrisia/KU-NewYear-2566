@extends('layouts.main')

@section('content')
    <div class="w-full">
        <div class="relative flex items-end justify-end mx-8 mt-4">
            <button class="absolute top-3 px-6 py-2 text-white mobile:text-sm  shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]" onclick="printDiv('printThis')">
                พิมพ์รายชื่อ
            </button>
        </div>
        <form action="{{ route('staff.prizes.show', ['id' => $prize->id])  }}" method="get" class="my-10 mx-8">
            <label for="search" class="md:text-lg">ค้นหาชื่อผู้ได้รับรางวัล</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input autocomplete="off" type="search" name="keyword" id="keyword" class="block w-full p-3 px-10 mt-3 text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-[#f2f0f0] focus:ring-blue-500 focus:border-blue-500 md:py-4" placeholder="" value="{{$keyword}}" required>
                <button type="submit" class="absolute right-3 md:right-5 bottom-2 bg-[#D9D9D9] text-gray-700 border border-[#d5d5d5] hover:bg-[#c3c1c1] focus:ring-4 focus:outline-none focus:ring-blue-300 shadow rounded-lg text-sm px-4 py-1.5 sm:px-6 md:text-base md:mb-0.5">ค้นหา</button>
            </div>
        </form> 
        <section class="w-full" id="printThis">
            <div class="mx-8">
                <h1 class="text-base sm:text-lg lg:text-xl mt-6">
                    รายชื่อผู้ได้รับรางวัล
                </h1>
                <p class="mobile:text-sm sm:text-base lg:text-lg mt-4">
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
                                <th scope="col" class="print:py-3 ptint:px-10"></th>
                            </tr>
                        </thead>
                        <tbody class="m-2">
                            @foreach($employees as $employee)
                            <tr class="border text-gray-700 text-sm mobile:text-xs sm:text-base">
                                <td class="px-10 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $employee->name }}</td>
                                <td class="px-6 py-4">{{ $employee->organizer->name }}</td>
                                <td class="print:px-14 print:py-4"></td>
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
