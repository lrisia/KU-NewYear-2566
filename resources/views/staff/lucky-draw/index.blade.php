@extends('layouts.main')

@section('content')
    <section class="w-full">
        <div class="mx-8">
        <h1 class="md:text-xl mt-10">
            รางวัลทั้งหมด
        </h1>
        <div class="my-4 overflow-x-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
            <table class="w-full text-left text-gray-60 mr-0">
                <thead class="bg-[#e7e6e6]">
                <tr>
                    <th scope="col" class="py-3 px-6">ชื่อรางวัล</th>
                    <th scope="col" class="py-3 px-6">ประเภท</th>
                    <th scope="col" class="py-3 px-6"></th>
                    <th scope="col" class="py-3 px-6 text-end">จำนวนรางวัล</th>
                    <th scope="col" class="py-3 px-6 text-end">จำนวนผู้มารับรางวัล</th>
                    <th scope="col" class="py-3 px-6"></th>
                </tr>
                </thead>

                <tbody class="m-2">
                @foreach($prizes as $prize)
                    <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base cursor-pointer hover:bg-gray-50" onclick="window.location='{{ route('staff.prizes.show', ['id' => $prize->id]) }}';">
                        <td class="px-6 py-4">รางวัลที่ {{ $prize->prize_no }}</td>
                        <td class="px-6 py-4">{{ $prize->type }}</td>
                        <td class="px-6 py-4">{{ $prize->description }}</td>
                        <td class="px-6 py-4 text-end">{{ $prize->total_amount }}</td>
                        <td class="px-6 py-4 text-end">{{ $prize->employees->where('took_prize', '=',  1)->count() }}</td>
                        <td class="flex flex-row items-center justify-center py-3">
                            <a href="{{ route('staff.prizes.show', ['id' => $prize->id]) }}" class="bg-[#D9D9D9] m-2 py-2 px-4 text-sm rounded-lg shadow-lg">ดูรายชื่อ</a>
                            <a href="{{ route('staff.prizes.select', ['id' => $prize->id]) }}" class="bg-[#B0C03B] m-2 text-white text-sm py-2 px-3 rounded-lg shadow-lg">เลือก</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </section>
@endsection
