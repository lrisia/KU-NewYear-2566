@extends('layouts.main')

@section('content')
    <section class="w-full">
        <div class="mx-8">
        <h1 class="md:text-xl mt-10">
            หน่วยงานทั้งหมด
        </h1>
        <div class="my-4 overflow-x-auto relative text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
            <table class="w-full text-left text-gray-60 mr-0">
                <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 px-6">รหัสหน่วยงาน</th>
                        <th scope="col" class="py-3 px-6">ชื่อหน่วยงาน</th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวนผู้ลงทะเบียน</th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวนผู้เข้าร่วมงาน</th>
                        <th scope="col" class="py-3 px-6 text-end">จำนวนผู้ได้รับรางวัล</th>
                    </tr>
                </thead>

                <tbody class="m-2">
                    @foreach($organizers as $organizer)
                    <tr class="border-t text-gray-700 cursor-pointer hover:bg-gray-50" onclick="window.location='{{ route('staff.organizers.show', ['id' => $organizer->fac_id]) }}';">
                        <td class="px-6 py-4">{{ $organizer->fac_id }}</td>
                        <td class="px-6 py-4">{{ $organizer->name }}</td>
                        <td class="px-6 py-4 text-end">
                            {{ $organizer->employees->whereNotNull('register_at')->count() }}
                        </td>
                        <td class="px-6 py-4 text-end">{{ $organizer->employees->whereNotNull('arrive_at')->count() }}</td>
                        <td class="px-6 py-4 text-end">{{ $organizer->employees->whereNotNull('got_prize_at')->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </section>
@endsection
