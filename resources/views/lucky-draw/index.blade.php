@extends('layouts.main-borderless')

@section('content')
    <div>
        <prize-draw url="{{ url('/') }}"
                    url_for_qrcode="{{ route('lucky-draw.show.no-id') }}"
                    video_name="{{ $filename }}"></prize-draw>
    </div>
@endsection
