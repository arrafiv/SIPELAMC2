@extends('layouts.master') 

@section('styles')
<style>
    .nav-wrapper {
        background-color: white;
    }
    
    #container {
        margin-top: 15em;
        margin-left: 1em;
    }
    
    #container2 {
        margin-top: 18em;
    }
    
    .brand-logo {
        margin-top: 3%;
        margin-left: 3%;
    }
    
    .leftHalf {
        /*        background: url(src/loginbackground.jpg);*/
        width: 70%;
        position: absolute;
        left: 0px;
        height: 100%;
    }
    
    .rightHalf {
        background-color: #F9F6F6;
        width: 30%;
        position: absolute;
        right: 0px;
        height: 100%;
    }
    
    .inPhone {
        width: 100%;
        position: absolute;
        left: 0px;
        right: 0px;
        height: 100%;
    }
    
    .inPhone::after {
        content: "";
        background: url(src/loginbackground.jpg);
        opacity: 0.3;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
    }
    
    .row .col {
        float: left;
        box-sizing: border-box;
        padding: 0;
    }
</style>
@endsection 

@section('content')
<div class="hide-on-med-and-down">
    <div class="leftHalf container">
        <div class="slider fullscreen">
            <ul class="slides">
                <li>
                    <img src="src/loginbackground.jpg">
                    <!-- random image -->
                    <div class="caption center-align">
                        <h3>This is our big Tagline!</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                </li>
                <li>
                    <img src="src/loginbackground.jpg">
                    <!-- random image -->
                    <div class="caption left-align">
                        <h3>Left Aligned Caption</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                </li>
                <li>
                    <img src="src/loginbackground.jpg">
                    <!-- random image -->
                    <div class="caption right-align">
                        <h3>Right Aligned Caption</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                </li>
                <li>
                    <img src="src/loginbackground.jpg">
                    <!-- random image -->
                    <div class="caption center-align">
                        <h3>This is our big Tagline!</h3>
                        <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="rightHalf">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo left"><img src="src/fia_header.png"></a>
            </div>
        </nav>
        <div id="container">
            <ul>
                <h3 class="grey-text text-darken-2">Portal Pelayanan Mahasiswa FIA</h3>
            </ul>
            <ul>
                <a href="{{action('Controller@loginredirect')}}" class="waves-effect waves-light btn pink darken-4">LOGIN SSO</a>
            </ul>
        </div>

    </div>
</div>

<div class="container hide-on-large-only">
    <div class="inPhone">
        <div class="row">
            <div class="col s12 center-align" id="container2">
                <ul>
                    <h3 class="grey-text text-darken-2">Portal Pelayanan Mahasiswa FIA</h3>
                </ul>
                <ul>
                    <a href="{{action('Controller@loginredirect')}}" class="waves-effect waves-light btn pink darken-4">LOGIN SSO</a>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('script')
<script>
    $(document).ready(function () {
        $('.slider').slider({
            full_width: true, indicators: false
        });
    });
</script>
@endsection