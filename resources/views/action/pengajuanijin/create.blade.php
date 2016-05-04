@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Izin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Izin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
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
        {!! Form::open(['url' => 'action/pengajuanijin/create']) !!}
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::text('nama', null, ['class' => 'validate', 'placeholder' => 'Nama dari Kegiatan', 'required' => "", 'aria-required' => 'true']) !!}
                    {!! Form::label('nama', 'Nama Kegiatan') !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::text('penyelenggara', null, ['class' => 'validate', 'placeholder' => 'Organisasi yang menyelenggarakan']) !!}
                    {!! Form::label('penyelenggara', 'Penyelenggara') !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    {!! Form::date('tanggal_mulai_kegiatan', null, ['class' => 'datepicker', 'placeholder' => 'Tanggal mulai']) !!}
                    {!! Form::label('tanggal_mulai_kegiatan', 'Tanggal Mulai Kegiatan') !!}
                </div>
                <div class="input-field col s12 l4">
                    {!! Form::date('tanggal_selesai_kegiatan', null, ['class' => 'datepicker', 'placeholder' => 'Tanggal selesai']) !!}
                    {!! Form::label('tanggal_selesai_kegiatan', 'Tanggal Selesai Kegiatan') !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::textarea('deskripsi', null, ['class' => 'materialize-textarea']) !!}
                    {!! Form::label('deskripsi', 'Deskripsi') !!}
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
            <button class="waves-effect waves-light btn pink darken-4">SUBMIT</button>
        {!! Form::close() !!}
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
















