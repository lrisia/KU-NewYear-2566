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
                            <td class="flex flex-row items-center justify-center py-3">
                                @if($prize->enable)
                                    <p class="bg-[#B0C03B] m-2 text-white text-center text-sm py-2 px-3 rounded-lg shadow-lg hover:bg-[#98a534]"
                                       onclick="popupToggle({{ $prize }})">จับรางวัล</p>
                                @else
                                    <a href="{{ route('staff.prizes.show', ['id' => $prize->id]) }}"
                                       class="bg-[#D9D9D9] m-2 py-2 px-4 text-sm rounded-lg shadow-lg hover:bg-[#C9C9C9]">รายชื่อผู้โชคดี</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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
                                    ยืนยันการเลือกรางวัลที่จะจับ
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
                            <div class="modal-body p-5 w-full overflow-y-auto ">
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500">
                                    ชื่อรางวัล: <span class="text-black" id="name"></span>
                                </p>
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    ประเภท: <span class="text-black" id="type"></span>
                                </p>
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    รายละเอียด: <span class="text-black" id="description"></span>
                                </p>
                                <p class="text-sm md:text-base mb-4 leading-relaxed text-gray-500 dark:text-gray-400">
                                    จำนวนทั้งหมด: <span class="text-black" id="amount"></span> รางวัล
                                </p>
                            </div>
                            <div class="modal-footer mb-4 px-5">
                                <div class="flex items-center justify-center space-x-2 rounded-b">
                                    <button onclick="popupToggle(null)"
                                        class="text-gray-500 mr-2 bg-gray-50 hover:bg-gray-200 shadow rounded-lg border border-[#DADADA] px-6 py-2">
                                        ยกเลิก
                                    </button>
                                    <form class="m-0" action="{{ route('staff.prizes.select') }}" method="POST">
                                        @csrf
                                        <input type="text" id="id" class="hidden" name="id">
                                        <input class="text-white shadow rounded-lg bg-[#B0C03B] hover:bg-[#98a534] px-8 py-2 flex" type="submit" value="ตกลง" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    function popupToggle(prize) {
        var modal = document.getElementById('modal');
        if (modal.style.display === 'block') {
            modal.style.display = 'none';
        } else {
            modal.style.display = 'block';
            document.getElementById('name').textContent = "รางวัลที่ " + prize.prize_no;
            document.getElementById('type').textContent = prize.type;
            document.getElementById('description').textContent = prize.description;
            document.getElementById('amount').textContent = prize.total_amount;
            document.getElementById('id').value = prize.id;
        }
    }
</script>
