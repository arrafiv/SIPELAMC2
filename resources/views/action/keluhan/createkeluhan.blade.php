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
        {!! Form::open(['url' => 'action/keluhan/createkeluhan']) !!}
            <div class="row">
                <div class="input-field col s12 m6">
                    {!! Form::select('prioritas', array('Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'), null, ['placeholder' => 'Prioritas']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                     {!! Form::select('divisi', array('Akademik' => 'Akademik', 'Infrastruktur' => 'Infrastruktur', 'Sarana dan Prasarana' => 'Sarana dan Prasarana'), null, ['placeholder' => 'Divisi']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::textarea('judul', null, ['class' => 'materialize-textarea']) !!}
                    {!! Form::label('judul', 'Judul') !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l8">
                    {!! Form::textarea('keluhan', null, ['class' => 'materialize-textarea']) !!}
                    {!! Form::label('keluhan', 'Keluhan') !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 l4">
                    {!! Form::email('email', $email_mhs, ['class' => 'validate', 'placeholder' => 'xxx@yyy.zzz']) !!}
                    {!! Form::label('email', 'Email') !!}
                </div>
                <div class="input-field col s12 l4">
                    {!! Form::text('no_hp', $no_hp, ['class' => 'validate', 'placeholder' => '08**********']) !!}
                    {!! Form::label('icon_telephone', 'Nomor Telepon') !!}
                </div>
            </div>
            <button class="waves-effect waves-light btn pink darken-4" onclick="Materialize.toast('Keluhan Berhasil Dibuat', 5000)">SUBMIT
            </button>
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














