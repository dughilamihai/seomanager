<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    @yield ('meta')
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css') }}">
    <link rel="stylesheet" href=" {{mix ('css/app.css')}}">
</head>

<body>
    <div class="container">
        @include ('layouts.navbar')

        @yield('content')

        @include ('layouts.footer')
    </div>
    @yield ('extra-script')
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>