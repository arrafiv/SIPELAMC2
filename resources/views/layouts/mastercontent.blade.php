<html lang="en">

<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{URL::to('materialize/css/materialize.css')}}">
    <link rel="stylesheet" href="{{URL::to('material/dataTables.material.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/sweetalert.css')}}">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script src="{{URL::to('material/jquery.dataTables.js')}}"></script>
    <script src="{{URL::to('material/dataTables.material.js')}}"></script>
    @yield('styles')
    <style>

    .brand-logo {
        margin: 1%;
    }
    
    nav .button-collapse i {
        font-size: 2rem;
        margin-left: .5em;
    }
    .side-nav {
    background-color: #F9F6F6;
    }
    header, main, footer {
    padding-left: 240px;
    }
    
    @media only screen and (max-width: 992px) {
        header,
        main,
        footer {
            padding-left: 0;
        }
    }
    .side-nav #div-li {
        margin-top: 5em;
    }
    .main {
        margin-top: 1em;
        margin-left: 2em;
        margin-right: 2em;
    }
    h4{
        font-weight: 200;
    }
        
    </style>
</head>

<body>
    @yield('navbar')
    @yield('sidebar-in-content')
    <main>
        @yield('content')
    </main>
    <script src="{{URL::to('dist/sweetalert.min.js')}}"></script>
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')
    @yield('script')
</body>

</html>