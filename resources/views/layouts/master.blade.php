<html>
<head>
@section('scripts')
        <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
@show
@section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
@show
</head>

<body>
@section('header')
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <a  style="font-size: 25px; margin-right: 30%" href="{{ url('/') }}"  class=" text-dark my-0 font-weight-normal">Главная страница</a>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ url('import') }}">Импорт / Экспорт</a>
            <a class="p-2 text-dark" href="{{ url('philosopher') }}">Философы</a>
            <a class="p-2 text-dark" href="{{ url('school') }}">Школы</a>
            <a class="p-2 text-dark" href="{{ url('definitions') }}">Понятия</a>
        </nav>
    </div>
@show



<div class="container">
    @yield('content')
</div>
</body>
</html>
