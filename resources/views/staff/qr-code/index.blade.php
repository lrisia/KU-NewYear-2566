@extends('layouts.main')

@section('content')
    <div>
        <scan-qr-code get_employee_api_url="{{ route('register.get-employee') }}"
                      store_attend_url="{{ route('qr-code.attend') }}"></scan-qr-code>
    </div>
@endsection
