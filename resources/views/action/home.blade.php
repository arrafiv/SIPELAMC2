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
    <div class="row" id="row">
        <div class="col s12 l9">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li class="active">
                    <div class="collapsible-header active">Sistem Pelayanan Mahasiswa</div>
                    <div class="collapsible-body">
                        <div class="row center-align">

                            <!-- ADMIN -->
                            @if ($role === "admin")
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getuser')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">User Manager</span></div>
                            </div>

                            <!-- SEKRETARIAT -->
                            @elseif ($role === "sekretariat")
                            <div class="col s12 m6 l3" id="assethome"><img src="{{URL::to('src/assethome-01.png')}}">
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarsurat')}}"><img src="{{URL::to('src/assethome-02.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pelayanan Akademik Surat</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarizin')}}"><img src="{{URL::to('src/assethome-04.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>

                            <!-- MANAJER -->
                            @elseif ($role === "manajer akademik")
                            <div class="col s12 m6 l3" id="assethome"><img src="{{URL::to('src/assethome-01.png')}}">
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><img src="{{URL::to('src/assethome-03.png')}}">
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarizin')}}"><img src="{{URL::to('src/assethome-04.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>

                             <!-- MAHASISWA -->
                            @else
                            <div class="col s12 m6 l3" id="assethome"><img src="{{URL::to('src/assethome-01.png')}}">
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getsurat')}}"><img src="{{URL::to('src/assethome-02.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pelayanan Akademik Surat</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><img src="{{URL::to('src/assethome-03.png')}}">
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getcreateizin')}}"><img src="{{URL::to('src/assethome-04.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>
                            @endif
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
                    <span class="grey-text text-darken-1">{!! $username !!}</span>

                    @if ($role === "mahasiswa")
                     <!-- Modal Trigger -->
                      <a class="modal-trigger" href="#modal1">
                        <i class="material-icons pink-text text-darken-4 right">mode_edit</i>
                      </a>
                      <!-- Modal Structure -->
                      <div id="modal1" class="modal">
                        <div class="modal-content">
                          {!! Form::open(['url' => 'action/home']) !!}
                            <div class="row">
                                <div class="input-field col s12 l4">
                                    {!! Form::email('email', null, ['class' => 'validate', 'placeholder' => 'xxx@yyy.zzz']) !!}
                                    {!! Form::label('email', 'Email') !!}
                                </div>
                                <div class="input-field col s12 l4">
                                    {!! Form::text('no_hp', null, ['class' => 'validate', 'placeholder' => '08**********']) !!}
                                    {!! Form::label('icon_telephone', 'Nomor Telepon') !!}
                                </div>
                            </div>
                            <div class="row">
                                <button class="waves-effect waves-light btn pink darken-4">SUBMIT</button>
                                <a class="modal-action modal-close btn grey darken-1">Close</a>
                            </div>
                            
                        {!! Form::close() !!}
                        </div>
                      </div>
                    @endif
                
                    <div class=""><p class="pink-text text-darken-4">{!! $role !!}</p></div>
                    @if ($role === "mahasiswa")
                    <br>
                    <br>
                    <span class="grey-text text-darken-1"><i class="material-icons pink-text text-darken-4">phone</i>  {!! $no_hp !!}</span>
                    <br>
                    <span class="grey-text text-darken-1"><i class="material-icons pink-text text-darken-4">email</i>  {!! $email !!}</span>
                    @endif
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
        $('.modal-trigger').leanModal();
    });
    </script>
    @endsection