@extends('layouts.main')

@section('content')
    <hello></hello>
    <img src="data:image/svg+xml;base64,{!! base64_encode(QrCode::format('svg')->size(100)->generate('Make me into an QrCode!')) !!} ">

@endsection
