@extends('layouts.main')

@section('content')
    <section class="w-full">
        <div class="mx-8">
            <img src="/image/Banner-2566.jpg" class="my-4 rounded-lg" style="width:100%;">
            <h1 class="flex justify-center space-x-3 text-3xl text-center font-bold mt-12">
                กำลังออกรางวัล
                <div
                    class="bg-black p-2 mt-3 w-4 h-4 rounded-full animate-bounce blue-circle"
                ></div>
                <div
                    class="bg-black p-2 mt-3  w-4 h-4 rounded-full animate-bounce green-circle"
                ></div>
                <div
                    class="bg-black p-2  mt-3  w-4 h-4 rounded-full animate-bounce red-circle"
                ></div>
            </h1>
        </div>
    </section>

    <style>
        .blue-circle{
            animation-delay: 0.1s;
        }
        .green-circle{
            animation-delay: 0.2s;
        }
        .red-circle{
            animation-delay: 0.3s;
        }
    </style>
@endsection
