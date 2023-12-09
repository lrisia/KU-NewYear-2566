@extends('layouts.main')

@section('content')
<section class="mt-4">
    @if($success == true)
        <p>Upload success.</p>
    @endif
    <form action="{{ route('staff.employees.upload.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="upload">Upload employee file here </label>
        <input name="upload" id="upload" type="file" class="cursor-pointer">
        <input type="submit" class="border-2 py-2 px-4 rounded-full cursor-pointer">
    </form>
</section>
@endsection
