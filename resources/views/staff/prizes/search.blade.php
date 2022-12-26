@extends('layouts.main')

@section('content')
    <section class="w-full">
        <div class="mx-8 justify-center @if ($employees->count() == 0) h-screen @endif">
            <form action="{{ route('staff.prizes.search') }}" method="get" class="mt-10">
                <label for="search" class="md:text-lg">ค้นหาชื่อผู้ได้รับรางวัล</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input autocomplete="off" type="search" name="keyword" id="keyword" class="block w-full p-3 px-10 mt-3 text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-[#f2f0f0] focus:ring-blue-500 focus:border-blue-500 md:py-4" placeholder="" value="{{$keyword}}" required>
                    <button type="submit" class="absolute right-3 md:right-5 bottom-2 bg-[#D9D9D9] text-gray-700 border border-[#d5d5d5] hover:bg-[#c3c1c1] focus:ring-4 focus:outline-none focus:ring-blue-300 shadow rounded-lg text-sm px-4 py-1.5 sm:px-6 md:text-base md:mb-0.5">ค้นหา</button>
                </div>
            </form>              
            <div class="my-6 overflow-x-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                <table class="w-full text-left mr-0">
                <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 px-6">ชื่อรางวัล</th>
                        <th scope="col" class="py-3 px-2"></th>
                        <th scope="col" class="py-3 px-2">ชื่อผู้ได้รับรางวัล</th>
                        <th scope="col" class="px-2">หน่วยงาน</th>
                        <th scope="col" class="px-2">เงินรางวัล</th>
                    </tr>
                </thead>
                    <tbody class="m-2">
                        @foreach($employees as $employee)
                        <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base">
                            <td class="px-6 py-4">{{ $employee->prize->type }}</td>
                            <td class="px-2 py-4">{{ $employee->prize->description }} จำนวน {{ $employee->prize->total_amount }} รางวัล</td>
                            <td class="px-2 py-4">{{ $employee->name }}</td>
                            <td class="px-2 py-4">{{ $employee->organizer->name }}</td>
                            <td class="px-2 py-4"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
