@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="#"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="#"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Permohonan Surat</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s12 l8">
                    <input placeholder="Isi nama" id="first_name" type="text" class="validate">
                    <label for="first_name">Nama</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    <input placeholder="1501234567" id="npm" type="text" class="validate">
					<label for="npm">NPM</label>
                </div>
            </div>
			<div class="row">
                <div class="input-field col s12 l8">
					<input placeholder="Jurusan" id="jurusan" type="text" class="validate">
                    <label for="jurusan">Jurusan</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
						<select class="browser-default">
							<option value="" disabled selected>Pilih Kategori Surat</option>
							<option value="1">Beasiswa</option>
							<option value="2">Transkrip Nilai</option>
						</select>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Keterangan</label>
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














