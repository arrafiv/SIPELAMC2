@extends('layouts.mastercontent')
@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@getcreatekeluhan')}}"><span class="pink-text text-darken-4">Ajukan Keluhan</span></a></li>
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getcreatekeluhan')}}"><span class="pink-text text-darken-4">Ajukan Keluhan</span></a></li>
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Keluhan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        {!! Form::model($keluhan, ['action' => ['Controller@updatekeluhan', $keluhan->id]]) !!}
        <div class="row">
            <div class="input-field col s12 m6">
                {!! Form::select('prioritas', array('Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'), null, ['class' => 'validate', 'placeholder' => 'Prioritas', 'required' => "", 'aria-required' => 'true']) !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l8">
                {!! Form::select('divisi', array('manajer akademik' => 'Akademik', 'manajer infrastruktur' => 'Infrastruktur', 'manajer sarpras' => 'Sarana dan Prasarana'), null, ['class' => 'validate', 'placeholder' => 'Divisi', 'required' => "", 'aria-required' => 'true']) !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l8">
                {!! Form::textarea('judul', null, ['class' => 'materialize-textarea', 'required' => "", 'aria-required' => 'true']) !!}
                {!! Form::label('judul', 'Judul') !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l8">
                {!! Form::textarea('keluhan', null, ['class' => 'materialize-textarea', 'required' => "", 'aria-required' => 'true']) !!}
                {!! Form::label('keluhan', 'Keluhan') !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l4">
                {!! Form::email('email', null, ['class' => 'validate', 'placeholder' => 'xxx@yyy.zzz', 'required' => "", 'aria-required' => 'true']) !!}
                {!! Form::label('email', 'Email') !!}
            </div>
            <div class="input-field col s12 l4">
                {!! Form::text('no_hp', null, ['class' => 'validate', 'placeholder' => '+62812********', 'pattern' => '^([0|\+[0-9]{1,5})?([1-9][0-9]{9})$', 'required' => "", 'aria-required' => 'true']) !!}
                {!! Form::label('icon_telephone', 'Nomor Telepon') !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l6">
                <div class="file-field input-field">
                    <div class="btn indigo darken-1">
                        <span>GAMBAR</span>
                        <input class="upload-file" type="file" name="image" accept="image/x-png, image/gif, image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="{!! $gambar !!}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l3">
                <button class="waves-effect waves-light btn pink darken-4" onclick="Materialize.toast('Keluhan Berhasil Diubah', 5000)">SUBMIT</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script>
$('select').material_select();
$(".button-collapse").sideNav();
$('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
selectYears: 15 // Creates a dropdown of 15 years to control year
});
</script>
@endsection