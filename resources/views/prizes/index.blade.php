@extends('layouts.main')

@section('content')
    <section class="w-full">
        <div class="mx-8">
            <img src="/image/Banner.jpg" class="my-4" style="width:100%;">
            <h1 class="md:text-xl mt-2">
                รางวัลทั้งหมด
            </h1>
            <div class="my-4 overflow-x-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 pl-2 pr-6 sm:pl-6">ชื่อรางวัล</th>
                        <th scope="col" class="py-3 px-6"></th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวนรางวัล</th>
                        <th scope="col" class="py-3 px-6"></th>
                    </tr>
                    </thead>

                    <tbody class="m-2">
                    @foreach($prizes as $prize)
                        <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base">
                            <td class="pl-2 sm:pl-6 sm:py-4">{{ $prize->type }}</td>
                            <td class="pl-4 sm:px-6 sm:py-4">{{ $prize->description }}</td>
                            <td class="pr-6 sm:px-6 sm:py-4 text-end">{{ $prize->total_amount }}</td>
                            <td class="flex flex-row items-center justify-center py-4">
                                @if($prize->enable)
                                    <p class="text-center text-gray-500 text-xs mr-1.5 py-1.5 sm:text-base sm:mr-0">
                                       ยังไม่จับรางวัล
                                    </p>
                                @else
                                    <a href="{{ route('lucky-draw.show', ['id' => $prize->id]) }}"
                                        class="bg-[#B0C03B] p-2 mr-1.5 sm:p-2 sm:text-sm sm:mr-0 text-white text-center text-xs rounded-lg shadow-lg hover:bg-[#98a534]">
                                        รายชื่อผู้โชคดี
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
