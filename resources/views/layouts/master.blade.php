<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::to('materialize/css/materialize.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
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