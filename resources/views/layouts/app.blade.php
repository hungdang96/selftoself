<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/regular.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    {{--<script src="{{asset('js/regular.js')}}"></script>--}}
    {{--<script src="{{asset('js/fontawesome.js')}}"></script>--}}
</head>
<body>
    <div id="app">
        @include('inc.navbar')

        @yield('content')
    </div>
    @yield('script')
    @include('inc.message')
</body>
</html>
