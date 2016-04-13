@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="#"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="#"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Pengajuan Ijin Kegiatan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s12 l8">
                    <input placeholder="Isi nama mu" id="first_name" type="text" class="validate">
                    <label for="first_name">Nama Kegiatan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    <input placeholder="Organisasi yang menyelenggarakan" id="first_name" type="text" class="validate">
                    <label for="first_name">Pihak Penyelenggara</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    <input type="date" class="datepicker">
                    <label>Tanggal Mulai Kegiatan</label>
                </div>
                <div class="input-field col s12 l4">
                    <input type="date" class="datepicker">
                    <label>Tanggal Selesai Kegiatan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Deskripsi Kegiatan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12 l4">
                    <input id="icon_telephone" type="tel" class="validate">
                    <label for="icon_telephone">Telephone</label>
                </div>
            </div>
            <a href="#" class="waves-effect waves-light btn pink darken-4">SUBMIT</a>
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














