@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@getCreateIzin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getCreateIzin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Ijin Kegitatan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
    <table class="highlight">
        <thead>
            <tr>
                <th data-field="username">User Name</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($daftarizin as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->deskripsi}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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














