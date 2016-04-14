@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
@if($usernameSSO === "kevin.mahendra")
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('isi-sidebar-in-content')
@if($usernameSSO === "kevin.mahendra")
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Surat</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
            <div class="s12 m4 l8">
                <table class="highlight">
                    <thead>
                        <tr>
                        @if ($usernameSSO === "kevin.mahendra")
                            <th data-field="tipe_surat">Tipe Surat</th>
                            <th data-field="keperluan">Keperluan</th>
                            <th data-field="status">Status</th>
                            <th class="center-align" data-field="action">Action</th>
                        @elseif ($usernameSSO === "rafida.fatimatuzzahra")
                            <th data-field="nama">Nama</th>
                            <th data-field="tipe_surat">Tipe Surat</th>
                            <th data-field="keperluan">Keperluan</th>
                            <th data-field="status">Status</th>
                            <th class="center-align" data-field="action">Action</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                    @if($usernameSSO === "kevin.mahendra")
                        @foreach($surat as $suratt)
                        <tr>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->keperluan}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>
                                <div class="center-align">
                                    @if($suratt->status === "Belum Diproses")
                                    <a href="{{action('Controller@editsurat', $suratt->id)}}">
                                        <i class="material-icons pink-text text-darken-4">mode_edit</i>
                                    </a>
                                    @else
                                        <i class="material-icons grey-text text-darken-2">mode_edit</i>
                                    @endif

                                    @if($suratt->status === "Belum Diproses")
                                        <a href="{{action('Controller@hapussurat', $suratt->id)}}">
                                            <i class="material-icons pink-text text-darken-4">delete</i>
                                        </a>
                                    @else
                                        <i class="material-icons grey-text text-darken-2">delete</i>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @elseif ($usernameSSO === "rafida.fatimatuzzahra")
                        @foreach($suratsekretariat as $suratt)
                        <tr>
                            <td>{{$suratt->nama}}</td>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->keperluan}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>
                                <div class="center-align">
                                    <i class="material-icons pink-text text-darken-4">swap_vert</i>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
</script>
@endsection