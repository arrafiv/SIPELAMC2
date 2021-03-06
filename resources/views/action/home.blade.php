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
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showcreateinfo')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarsurat')}}"><img src="{{URL::to('src/assethome-02.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pelayanan Akademik Surat</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarizin')}}"><img src="{{URL::to('src/assethome-04.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showreportsurat')}}"><img src="{{URL::to('src/analytics-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Analisis dan Report</span></div>
                            </div>

                            <!-- MANAJER AKADEMIK -->
                            @elseif ($role === "manajer akademik")
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showinfo_kemahasiswaan')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarkeluhan')}}"><img src="{{URL::to('src/assethome-03.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarizin')}}"><img src="{{URL::to('src/assethome-04.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showreportizin')}}"><img src="{{URL::to('src/analytics-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Analisis dan Report</span></div>
                            </div>

                            <!-- MANAJER SARPRAS -->
                            @elseif ($role === "manajer sarpras")
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showinfo_kemahasiswaan')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarkeluhan')}}"><img src="{{URL::to('src/assethome-03.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showreportkeluhan')}}"><img src="{{URL::to('src/analytics-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Analisis dan Report</span></div>
                            </div>

                            <!-- MANAJER INFRASTRUKTUR -->
                            @elseif ($role === "manajer infrastruktur")
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showinfo_kemahasiswaan')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getdaftarkeluhan')}}"><img src="{{URL::to('src/assethome-03.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showreportkeluhan')}}"><img src="{{URL::to('src/analytics-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Analisis dan Report</span></div>
                            </div>

                             <!-- MAHASISWA -->
                            @elseif($role === "mahasiswa")
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showinfo_kemahasiswaan')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getsurat')}}"><img src="{{URL::to('src/assethome-02.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pelayanan Akademik Surat</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getcreatekeluhan')}}"><img src="{{URL::to('src/assethome-03.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getcreateizin')}}"><img src="{{URL::to('src/assethome-04.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Pengajuan Ijin</span></div>
                            </div>
                            @else
                             <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@showinfo_kemahasiswaan')}}"><img src="{{URL::to('src/assethome-01.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></div>
                            </div>
                            <div class="col s12 m6 l3" id="assethome"><a href="{{action('Controller@getcreatekeluhan')}}"><img src="{{URL::to('src/assethome-03.png')}}"></a>
                                <div class="desc"><span class="pink-text text-darken-4">Keluhan dan Usulan</span></div>
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
                                    {!! Form::email('email', $email, ['class' => 'validate', 'placeholder' => 'xxx@yyy.zzz', 'required' => "", 'aria-required' => 'true']) !!}
                                    {!! Form::label('email', 'Email') !!}
                                </div>
                                <div class="input-field col s12 l4">
                                    {!! Form::text('no_hp', $no_hp, ['class' => 'validate', 'placeholder' => '08**********', 'pattern' => '^([0|\+[0-9]{1,5})?([1-9][0-9]{9})$', 'required' => "", 'aria-required' => 'true']) !!}
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
                
                    <div class=""><p class="pink-text text-darken-4">{!! $role !!}</p></div>
                    <br>
                    <br>
                    <span class="grey-text text-darken-1"><i class="material-icons pink-text text-darken-4">phone</i>  {!! $no_hp !!}</span>
                    <br>
                    <span class="grey-text text-darken-1"><i class="material-icons pink-text text-darken-4">email</i>  {!! $email !!}</span>
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