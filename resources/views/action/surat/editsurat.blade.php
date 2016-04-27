@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Edit Permohonan Surat</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        {!! Form::model($surat, ['action' => ['Controller@updatesurat', $surat->id]]) !!}
            <div class="row">
                <div class="input-field col s12 m6">
                    {!! Form::select('tipe_surat', array('Beasiswa' => 'Beasiswa', 'Transkrip Nilai' => 'Transkrip Nilai'), null, ['placeholder' => 'Pilih salah satu surat']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::textarea('keperluan', null, ['class' => 'materialize-textarea']) !!}
                    {!! Form::label('keperluan', 'Keperluan Surat') !!}
                </div>
            </div>
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
            <button class="waves-effect waves-light btn pink darken-4" onclick="Materialize.toast('Surat Berhasil Diubah', 4000)">SUBMIT</button>
        {!! Form::close() !!}
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
    $('select').material_select();
</script>
@endsection














