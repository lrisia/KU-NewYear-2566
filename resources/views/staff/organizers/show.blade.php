@extends('layouts.main')

@section('content')
    <section class="w-full @if ($employees->count() <= 7) min-h-screen @endif">
        <div class="mx-8">
        <h1 class="md:text-xl mt-10">
            หน่วยงาน: {{ $organizer->name }}
        </h1>
        <div class="my-4 overflow-x-auto relative text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
            <table class="w-full text-left text-gray-60 mr-0">
                <thead class="bg-[#e7e6e6]">
                    <tr>
                        <th scope="col" class="py-3 pl-10 pr-4">ลำดับ</th>
                        <th scope="col" class="py-3 px-6">ชื่อ-นามสกุล</th>
                        <th scope="col" class="py-3 px-6 text-center">สถานะการลงทะเบียน</th>
                    </tr>
                </thead>
                <tbody class="m-2">
                    @foreach($employees as $employee)
                    <tr class="border-t text-gray-700">
                        <td class="px-10 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $employee->name }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($employee->register_at != null)
                                <p class="text-[#818c2b] my-2 ml-4">ลงทะเบียนแล้ว</p>
                            @else
                                <p class="text-red-400 my-2 ml-4">ไม่ได้ลงทะเบียน</p>
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
