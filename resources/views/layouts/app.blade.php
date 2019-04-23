<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Balaji Realty') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="{{asset('css/StyleSheet1.css')}}">
    <link href="{{ asset('css/animated_carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/card.css">

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2LnKcqcsKSOehDo_fM_t81G6Ynxdxufs&libraries=places"></script>

</head>
<body>
    <div id='app'>
        <div class="pageContentWrapper">

            @include('inc.navbar')

            <div style="padding-top:40px;margin-border:20px;margin-top:10px;">
                <hr style="height:2px;border:none;color:#333;background-color:#333">


            @yield('content')

            </div>
        </div>

        <br>
        <div class=" row">
            @include('inc.footer')
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/myscript.js')}}"></script>

</body>
</html>
