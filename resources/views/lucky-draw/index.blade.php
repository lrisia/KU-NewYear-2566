@extends('layouts.main-borderless')

@section('content')
    <div>
        <prize-draw url="{{ url('/') }}" url_for_qrcode="{{ route('lucky-draw.show.no-id') }}"></prize-draw>
    </div>
@endsection
