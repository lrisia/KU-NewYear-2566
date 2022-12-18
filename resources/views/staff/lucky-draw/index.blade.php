@extends('layouts.main')

@section('content')
    <section>
        <div class="my-4 overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-left text-gray-60 mr-0">
                <thead class="bg-[#e7e6e6]">
                <tr>
                    <th scope="col" class="py-3 px-6">type</th>
                    <th scope="col" class="py-3 px-6">description</th>
                    <th scope="col" class="py-3 px-6 text-end">prize_no</th>
                    <th scope="col" class="py-3 px-6 text-end">total_amount</th>
                    <th scope="col" class="py-3 px-6 text-end">left_amount</th>
                    <th scope="col" class="py-3 px-6"></th>
                </tr>
                </thead>

                <tbody class="m-2">
                @foreach($prizes as $prize)
                    <tr class="border-t text-gray-700 cursor-pointer hover:bg-gray-50" onclick="window.location='{{ route('staff.prizes.select', ['id' => $prize->id]) }}';">
                        <td class="px-6 py-4">{{ $prize->type }}</td>
                        <td class="px-6 py-4">{{ $prize->description }}</td>
                        <td class="px-6 py-4 text-end">{{ $prize->prize_no }}</td>
                        <td class="px-6 py-4 text-end">{{ $prize->total_amount }}</td>
                        <td class="px-6 py-4 text-end">{{ $prize->left_amount }}</td>
                        <td>
                            <button class="bg-[#B0C03B] text-white py-2 px-4 rounded-lg shadow-lg">เลือก</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
