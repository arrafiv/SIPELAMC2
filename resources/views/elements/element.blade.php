@section('navbar')
<header>
<nav>
    <div class="nav-wrapper white">
        <a href="#" class="brand-logo"><img src="{{URL::to('src/fia_header.png')}}"></a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="tiny material-icons pink-text text-darken-4">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="{{action('Controller@portaltohome')}}"><span class="grey-text text-darken-1">Portal</span></a></li>   
            <li><a href="{{action('Controller@logout')}}"><span class="grey-text text-darken-1">Logout</span></a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{action('Controller@portaltohome')}}"><span class="pink-text text-darken-4">Portal</span></a></li>   
            <li><a href="{{action('Controller@logout')}}"><span class="pink-text text-darken-4">Logout</span></a></li>
            @yield('isi-side-nav')
        </ul>
    </div>
</nav>
</header>
@endsection


@section('sidebar-in-content')
<ul id="slide-out" class="side-nav fixed">
    <div id="div-li">
       @yield('isi-sidebar-in-content')
    </div>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
@endsection