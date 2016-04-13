@extends('layouts.master') @section('styles')
<style>
    body {
        background-color: #F9F6F6;
    }
    
    #row {
        margin: 2em;
    }
    
    #assethome {
        margin-top: 2em;
    }
</style>
@endsection @extends('elements.element') @section('content')
<div>
    <div class="row" id="row">
        <div class="col s12 l9">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li class="active">
                    <div class="collapsible-header active">Sistem Pelayanan Mahasiswa</div>
                    <div class="collapsible-body">
                        <div class="row center-align">
                            <div class="col s12 m6 l3" id="assethome"><img src="src/assethome-01.png">
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getsurat')}}"><img src="src/assethome-02.png"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pelayanan Akademik Surat</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><img src="src/assethome-03.png">
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getCreateIzin')}}"><img src="src/assethome-04.png"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">Second</div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">Third</div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s12 l3">
            <div class="card blue-grey lighten-5">
                <div class="card-content white">
                    <span class="card-title">Card Title</span>
                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
            </div>
        </div>
    </div>

    @endsection @section('script')
    <script>
        $(document).ready(function () {
        $('.slider').slider({
            full_width: true
        });
        $(".button-collapse").sideNav();
    });
    </script>
    @endsection