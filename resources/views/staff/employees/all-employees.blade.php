@extends('layouts.main')

@section('content')
<section class=" @if ($employees->count() <= 3) min-h-screen @endif">
  <div class="mx-10 justify-center" >
    <form action="{{ route('staff.employees') }}" method="get" class="my-10">
        <label for="search" class="md:text-lg">ค้นหาชื่อบุคลากร</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input autocomplete="off" type="search" name="keyword" value="{{ $keyword }}" id="keyword" class="block w-full p-3 px-10 mt-3 text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-[#f2f0f0] focus:ring-blue-500 focus:border-blue-500 md:py-4" placeholder="">
            <button type="submit" class="absolute right-3 md:right-5 bottom-2 bg-[#D9D9D9] text-gray-700 border border-[#d5d5d5] hover:bg-[#c3c1c1] focus:ring-4 focus:outline-none focus:ring-blue-300 shadow rounded-lg text-sm px-4 py-1.5 sm:px-6 md:text-base md:mb-0.5">ค้นหา</button>
        </div>
    </form>

    <h1 class="md:text-lg">รายชื่อบุคลากรทั้งหมด {{ $employees->total() }} คน เป็นอิสลามจำนวน {{ $employees->where('islam', true)->count() }} คน</h1>
    <div class="my-4 overflow-x-auto relative text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
        <table class="w-full text-left text-gray-60 mr-0">
            <thead class="bg-[#e7e6e6]">
                <tr>
                    <th scope="col" class="py-3 pl-6 pr-4">ลำดับ</th>
                    <th scope="col" class="py-3 px-6">ชื่อ-นามสกุล</th>
                    <th scope="col" class="py-3 pr-4">หน่วยงาน</th>
                    <th scope="col" class="py-3 px-6">อีเมล</th>
                    <th scope="col" class="py-3 px-10 text-center">สถานะการลงทะเบียน</th>
                    <th scope="col" class="py-3 px-10 text-center">สถานะการเข้าร่วมงาน</th>
                </tr>
            </thead>
            <tbody class="m-2">
                @foreach($employees as $employee)
                <tr class="border-t text-gray-700">
                    <td class="px-6 py-4">{{ $employees->firstItem() + $loop->index }}</td>
                    <td class="px-6 py-4">
                        <div>
                            <p>{{ $employee->name }}</p>
                            @if ($employee->islam)
                                <p class="text-xs sm:text-sm text-gray-500">(ศาสนาอิสลาม)</p>
                            @endif
                        </div>
                    </td>
                    <td class="pr-6 py-4">{{ $employee->organizer->name }}</td>
                    <td class="px-6 py-4">{{ $employee->email }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($employee->register_at != null)
                            <p class="text-green-700 my-2">ลงทะเบียนแล้ว</p>
                        @else
                            <p class="text-red-500 my-2">ไม่ได้ลงทะเบียน</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($employee->arrive_at != null)
                            <p class="my-2">เข้าร่วมงานแล้ว</p>
                        @else
                            <attend-popup :employee="{{ $employee->toJson() }}" organizer_name="{{ $employee->organizer->name }}" url="{{ url("/") }}"></attend-popup>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $employees->withQueryString()->links() }}
    </div>

  </div>
</section>

@endsection
