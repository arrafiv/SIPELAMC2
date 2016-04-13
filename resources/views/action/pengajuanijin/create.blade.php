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
<!--     <form action = "{{url('action/pengajuanijin/create') }}" method="POST" >
    {!! csrf_field() !!} -->
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Pengajuan Ijin Kegiatan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <form class="col s12" action = "{{url('action/pengajuanijin/create') }}" method="POST" >
            {!! csrf_field() !!}
            <div class="row">
                <div class="input-field col s12 l8">
                    <input placeholder="Nama dari kegiatan yang diajukan" name="nama" id="first_name" type="text" class="validate">
                    <label for="first_name">Nama Kegiatan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    <input placeholder="Organisasi yang menyelenggarakan" name="penyelenggara" id="first_name" type="text" class="validate">
                    <label for="first_name">Pihak Penyelenggara</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    <input type="date" name="tanggal_mulai_kegiatan" class="datepicker">
                    <label>Tanggal Mulai Kegiatan</label>
                </div>
                <div class="input-field col s12 l4">
                    <input type="date" name="tanggal_selesai_kegiatan" class="datepicker">
                    <label>Tanggal Selesai Kegiatan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    <textarea id="textarea1" name="deskripsi" class="materialize-textarea"></textarea>
                    <label for="textarea1">Deskripsi Kegiatan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    <input placeholder="xxx@yyy.zzz"id="email" name="email" type="email" class="validate">
                    <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>
                <div class="input-field col s12 l4">
                    <input id="icon_telephone" name="no_hp" type="tel" class="validate">
                    <label for="icon_telephone">Telephone</label>
                </div>
            </div>
            <button class="waves-effect waves-light btn pink darken-4">SUBMIT</button>
        </form>
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














