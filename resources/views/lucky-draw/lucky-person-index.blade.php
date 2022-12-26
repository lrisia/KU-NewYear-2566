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
                        <th scope="col" class="py-3 pl-6">ชื่อรางวัล</th>
                        <th scope="col" class="py-3 px-6"></th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวนรางวัล</th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                    </thead>

                    <tbody class="m-2">
                    @foreach($prizes as $prize)
                        <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base cursor-pointer hover:bg-gray-50">
                            <td class="pl-6 py-4">{{ $prize->type }}</td>
                            <td class="px-6 py-4">{{ $prize->description }}</td>
                            <td class="px-6 py-4 text-end">{{ $prize->total_amount }}</td>
                            @if (!$prize->enable)
                                <td class="flex flex-row items-center justify-center py-3">
                                    <a class="bg-[#B0C03B] m-2 text-white text-center text-sm py-2 px-3 rounded-lg shadow-lg hover:bg-[#98a534]"
                                       href="{{ route('lucky-draw.show', ['id' => $prize->id]) }}">รายชื่อผู้โชคดี</a>
                                </td>
                            @else
                                <td class="pl-6 py-4"></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
