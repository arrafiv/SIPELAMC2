<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::to('materialize/css/materialize.css')}}">
    <script type="text/javascript" src="{{URL::to('materialize/js/jquery-2.1.4.js')}}"></script>
    <script src="{{URL::to('materialize/js/materialize.min.js')}}"></script>
    @yield('styles')
    <style>
    .brand-logo {
        margin: 1%;
    }
    
    nav .button-collapse i {
        font-size: 2rem;
        margin-left: .5em;
    }
    body {
    background-color: #F9F6F6;
    }
    </style>
</head>

<body>
    @yield('navbar')
    @yield('content')
    @yield('script')
</body>

</html>