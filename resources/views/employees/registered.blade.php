@extends('layouts.main')

@section('content')
<section>
  <div class="mx-10 justify-center">
    <form action="{{ route('employees.registered') }}" method="get" class="my-10">
        <label for="search" class="md:text-lg">ค้นหาชื่อผู้ลงทะเบียน</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search" name="keyword" value="{{ $keyword }}" id="keyword" class="block w-full p-3 px-10 mt-3 text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-[#f2f0f0] focus:ring-blue-500 focus:border-blue-500 md:py-4" placeholder="" required>
            <button type="submit" class="absolute right-3 md:right-5 bottom-2 bg-[#D9D9D9] text-gray-700 border border-[#d5d5d5] hover:bg-[#c3c1c1] focus:ring-4 focus:outline-none focus:ring-blue-300 shadow rounded-lg text-sm px-4 py-1.5 sm:px-6 md:text-base md:mb-0.5">ค้นหา</button>
        </div>
    </form>

    <h1 class="md:text-lg">รายชื่อผู้ที่ลงทะเบียนแล้วมีจำนวน {{$employees->count()}} คน</h1>
    @foreach($employees as $employee)
      <div class="block w-full p-3 py-4 my-4 text-sm text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-white md:text-base md:p-3 md:py-6" >
          <div class="grid grid-cols-3 gap-4 content-start">
              <p class="my-2 ml-4">{{ $employee->name }}</p>
              <p class="my-2">{{ $employee->organizer->name }}</p>
              <p class="my-2">{{ $employee->register_at->format('d M H:i:s') }}</p>
          </div>
      </div>
    @endforeach

      <div>
          {{ $employees->withQueryString()->links() }}
      </div>

  </div>
</section>

@endsection
