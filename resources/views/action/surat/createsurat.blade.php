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
            <h4 class="grey-text text-darken-1">Permohonan Surat</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        {!! Form::open(['url' => 'action/surat/createsurat']) !!}
            <div class="row">
                <div class="input-field col s12 m6">
                    {!! Form::select('tipe_surat', array('Beasiswa' => 'Beasiswa', 'Transkrip Nilai' => 'Transkrip Nilai'), null, ['class' => 'validate', 'placeholder' => 'Pilih salah satu surat', 'required' => "", 'aria-required' => 'true']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::textarea('keperluan', null, ['class' => 'materialize-textarea', 'required' => "", 'aria-required' => 'true']) !!}
                    {!! Form::label('keperluan', 'Keperluan Surat') !!}
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
            <button class="waves-effect waves-light btn pink darken-4">SUBMIT</button>
        {!! Form::close() !!}
        </form>
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




