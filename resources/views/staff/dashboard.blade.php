@extends('layouts.main')

@section('content')
    <div class="grid grid-cols-2 gap-10">
        <div>
            <h1 class="md:text-xl mt-10">
                10 อันดับหน่วยงานที่ลงทะเบียนสูงสุด
            </h1>
            <div class="my-4 overflow-x-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 px-6 text-center ">อันดับ</th>
                        <th scope="col" class="py-3 px-6">ชื่อหน่วยงาน</th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวน</th>
                    </tr>
                    </thead>
                    <tbody class="m-2">
                    @foreach($top_register as $organizer)
                        <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base cursor-pointer hover:bg-gray-50" onclick="window.location='{{ route('staff.organizers.show', ['id' => $organizers->where('id', $organizer->organizer_id)->first()->fac_id]) }}'">
                            @if ($loop->iteration == 1)
                                <td class="py-4 bg-[#FCD638] text-center">{{ $loop->iteration }}</td>
                            @elseif ($loop->iteration == 2)
                                <td class="py-4 bg-[#C6C6C6] text-center">{{ $loop->iteration }}</td>
                            @elseif ($loop->iteration == 3)
                                <td class="py-4 bg-[#FEA778] text-center">{{ $loop->iteration }}</td>
                            @else
                                <td class="py-4 text-center">{{ $loop->iteration }}</td>
                            @endif
                            <td class="px-6 py-4">{{ $organizers->where('id', $organizer->organizer_id)->first()->name }}</td>
                            <td class="px-6 py-4 text-end">{{ $organizer->employee_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <h1 class="md:text-xl mt-10">
                10 อันดับหน่วยงานที่เข้าร่วมงานสูงสุด
            </h1>
            <div class="my-4 overflow-x-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 px-6 text-center ">อันดับ</th>
                        <th scope="col" class="py-3 px-6">ชื่อหน่วยงาน</th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวน</th>
                    </tr>
                    </thead>
                    <tbody class="m-2">
                    @foreach($top_attend as $organizer)
                        <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base cursor-pointer hover:bg-gray-50" onclick="window.location='{{ route('staff.organizers.show', ['id' => $organizers->where('id', $organizer->organizer_id)->first()->fac_id]) }}'">
                            @if ($loop->iteration == 1)
                                <td class="py-4 bg-[#FCD638] text-center">{{ $loop->iteration }}</td>
                            @elseif ($loop->iteration == 2)
                                <td class="py-4 bg-[#C6C6C6] text-center">{{ $loop->iteration }}</td>
                            @elseif ($loop->iteration == 3)
                                <td class="py-4 bg-[#FEA778] text-center">{{ $loop->iteration }}</td>
                            @else
                                <td class="py-4 text-center">{{ $loop->iteration }}</td>
                            @endif
                            <td class="px-6 py-4">{{ $organizers->where('id', $organizer->organizer_id)->first()->name }}</td>
                            <td class="px-6 py-4 text-end">{{ $organizer->employee_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <h1 class="md:text-xl mt-10">
                10 อันดับหน่วยงานที่ได้รับรางวัลสูงสุด
            </h1>
            <div class="my-4 overflow-x-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                <table class="w-full text-left text-gray-60 mr-0">
                    <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 px-6 text-center ">อันดับ</th>
                        <th scope="col" class="py-3 px-6">ชื่อหน่วยงาน</th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวน</th>
                    </tr>
                    </thead>
                    <tbody class="m-2">
                    @foreach($top_prize as $organizer)
                        <tr class="border-t text-gray-700 text-sm mobile:text-xs sm:text-base cursor-pointer hover:bg-gray-50" onclick="window.location='{{ route('staff.organizers.show', ['id' => $organizers->where('id', $organizer->organizer_id)->first()->fac_id]) }}'">
                            @if ($loop->iteration == 1)
                                <td class="py-4 bg-[#FCD638] text-center">{{ $loop->iteration }}</td>
                            @elseif ($loop->iteration == 2)
                                <td class="py-4 bg-[#C6C6C6] text-center">{{ $loop->iteration }}</td>
                            @elseif ($loop->iteration == 3)
                                <td class="py-4 bg-[#FEA778] text-center">{{ $loop->iteration }}</td>
                            @else
                                <td class="py-4 text-center">{{ $loop->iteration }}</td>
                            @endif
                            <td class="px-6 py-4">{{ $organizers->where('id', $organizer->organizer_id)->first()->name }}</td>
                            <td class="px-6 py-4 text-end">{{ $organizer->employee_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
