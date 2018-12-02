<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel 5.1</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    

</head>
<body>
    @yield('content')
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>