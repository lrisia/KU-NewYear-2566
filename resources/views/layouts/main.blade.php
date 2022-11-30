<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>KU New Year</title>
    <style ref="{{ mix('css/app.css') }}"></style>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet"/>
</head>
<body>
    @include('layouts.navbar')

    <div class="mx-auto max-w-7xl" id="app">
        @yield('content')
    </div>

</body>
</html>
