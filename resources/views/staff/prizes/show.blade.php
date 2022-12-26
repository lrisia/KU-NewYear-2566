@extends('layouts.main')

@section('content')
    <div class="w-full @if ($employees->count() == 0) min-h-screen @endif">
        <div class="relative flex items-end justify-end mx-8 mt-4">
            <button
                class="absolute top-3 px-6 py-2 text-white mobile:text-sm  shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534]"
                onclick="printDiv('printThis')">
                พิมพ์รายชื่อ
            </button>
        </div>
        <form action="{{ route('staff.prizes.show', ['id' => $prize->id])  }}" method="get" class="my-10 mx-8">
            <label for="search" class="md:text-lg">ค้นหาชื่อผู้ได้รับรางวัล</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input autocomplete="off" type="search" name="keyword" id="keyword"
                       class="block w-full p-3 px-10 mt-3 text-gray-700 shadow border border-[#e5e5e5] rounded-lg bg-[#f2f0f0] focus:ring-blue-500 focus:border-blue-500 md:py-4"
                       placeholder="" value="{{$keyword}}" required>
                <button type="submit"
                        class="absolute right-3 md:right-5 bottom-2 bg-[#D9D9D9] text-gray-700 border border-[#d5d5d5] hover:bg-[#c3c1c1] focus:ring-4 focus:outline-none focus:ring-blue-300 shadow rounded-lg text-sm px-4 py-1.5 sm:px-6 md:text-base md:mb-0.5">
                    ค้นหา
                </button>
            </div>
        </form>
        <section class="w-full" id="printThis">
            <div class="mx-8">
                <h1 class="text-base sm:text-lg lg:text-xl mt-6">
                    รายชื่อผู้ได้รับรางวัล
                </h1>
                <p class="mobile:text-sm sm:text-base lg:text-lg mt-4">
                    <span class="mr-2">{{ $prize->type }}</span>
                    <span class="mr-2">{{ $prize->description }}</span>
                    <span class="mr-2">จำนวน {{ $prize->total_amount }} รางวัล</span>
                </p>
                <div class="mt-4 overflow-auto text-sm mobile:text-xs sm:text-base shadow-md rounded-lg">
                    <table class="w-full text-left mr-0">
                        <thead class="bg-[#e7e6e6] border-2 text-sm mobile:text-xs sm:text-base">
                            <tr>
                                <th scope="col" class="py-2 px-6 pr-4 print:border-r">ลำดับ</th>
                                <th scope="col" class="py-2 px-2 print:border-r">ชื่อ-นามสกุล</th>
                                <th scope="col" class="py-2 pl-2 print:border-r">หน่วยงาน</th>
                                <th scope="col" class="print:py-3 print:px-10"><p class="invisible print:visible text-center">เซ็นชื่อ</p></th>
                            </tr>
                        </thead>
                        <tbody class="m-2">
                            @foreach($employees as $employee)
                            <tr class="border border-r-2 text-gray-700 text-sm mobile:text-xs sm:text-base">
                                <td class="px-4 py-4 print:py-8 print:border-r">{{ $loop->iteration }}</td>
                                <td class="px-2 py-4 print:py-8 print:border-r print:w-1/4">{{ $employee->name }}</td>
                                <td class="pl-2 py-2 print:py-8 print:border-r print:w-1/4">{{ $employee->organizer->name }}</td>
                                <td class="invisible print:px-24 print:py-8"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($employees->count() == 0)
                    <div class="text-center py-4 text-gray-400 bg-gray-50 rounded-b-lg">
                        <p>ยังไม่ได้จับรางวัลนี้</p>
                    </div>
                @endif
                <div class="mb-4"></div>
            </div>
        </section>
        <div class="relative">
            <a class="absolute left-8 cursor-pointer" href="{{ route('staff.prizes') }}">< <u>back</u></a>
        </div>
        @if (!$prize->close)
            <div class="relative">
                <p onclick="popupToggle({{ $prize }})"
                   class="absolute right-8 px-6 py-2 text-white mobile:text-sm shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534] cursor-pointer">
                    ปิดการรับรางวัล
                </p>
            </div>
        @endif
    </div>
    <mqtt-refresh timeout="1650"></mqtt-refresh>

    <div id="modal" class="hidden h-full w-full flex items-center justify-center">
        <div class="fixed inset-0 z-30">
            <div onclick="popupToggle(null)"
                 class="bg-filter bg-white opacity-25 fixed inset-0 w-full h-full z-20"></div>
            <div class="flex flex-col items-center justify-center h-full w-full">
                <div class="modal-wrapper flex items-center z-30">
                    <div
                        class="modal max-w-md mx-auto xl:max-w-5xl lg:max-w-5xl md:max-w-2xl bg-white max-h-screen shadow-lg flex-row rounded relative">
                        <div
                            class="modal-header flex p-2.5 md:p-4 rounded-t border-b border-gray-200 bg-[#F2F2F2] shadow">
                            <h3 class="text-base md:text-lg font-semibold text-gray-900">
                                ปิดการรับ{{ $prize->type }}
                            </h3>
                            <button onclick="popupToggle(null)" type="button"
                                    class="text-gray-600 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <form class="m-0" action="{{ route('staff.prizes.close') }}" method="GET">
                            <div class="modal-body px-5 pt-5 w-full overflow-y-auto ">
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    รายละเอียด: <span class="text-black" id="description"></span>
                                </p>
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    จำนวนทั้งหมด: <span class="text-black" id="amount"></span> รางวัล
                                </p>
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    ใส่จำนวนผู้ที่ไม่มารับรางวัล:
                                </p>
                            </div>
                            <div class="modal-footer mb-4 px-5">
                                <div class="flex items-center justify-center space-x-2 rounded-b">
                                    <input type="number" required name="amount" min="0" max="{{ $prize->total_amount }}"
                                           class="text-gray-500 mr-2 bg-gray-50 shadow rounded-lg border border-[#DADADA] py-2 w-48"/>
                                    <input type="text" id="id" class="hidden" name="id">
                                    <input
                                        class="cursor-pointer text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534] px-8 py-2 flex"
                                        type="submit" value="ตกลง"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        location.reload();
    }

    function popupToggle(prize) {
        var modal = document.getElementById('modal');
        if (modal.style.display === 'block') {
            modal.style.display = 'none';
        } else {
            modal.style.display = 'block';
            document.getElementById('description').textContent = prize.description;
            document.getElementById('amount').textContent = prize.total_amount;
            document.getElementById('id').value = prize.id;
        }
    }
</script>
