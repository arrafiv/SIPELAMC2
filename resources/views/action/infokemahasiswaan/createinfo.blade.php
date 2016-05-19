@extends('layouts.mastercontent')
@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@showcreateinfo')}}"><span class="pink-text text-darken-4">Buat Info</span></a></li>
<li><a href="{{action('Controller@showinfokemahasiswaan')}}"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></a></li>
<li><a href="{{action('Controller@getdaftarinfo')}}"><span class="pink-text text-darken-4">Published</span></a></li>
<li><a href="{{action('Controller@getdaftarinfodraft')}}"><span class="pink-text text-darken-4">Draft</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@showcreateinfo')}}"><span class="pink-text text-darken-4">Buat Info</span></a></li>
<li><a href="{{action('Controller@showinfokemahasiswaan')}}"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></a></li>
<li><a href="{{action('Controller@getdaftarinfo')}}"><span class="pink-text text-darken-4">Published</span></a></li>
<li><a href="{{action('Controller@getdaftarinfodraft')}}"><span class="pink-text text-darken-4">Draft</span></a></li>
@endsection
@section('styles')
<style type="text/css">
#buttoninfo{
margin-top: 2em;
}
</style>
@endsection
@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Buat Info Kemahasiswaan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        {!! Form::open(['url' => 'action/infokemahasiswaan/createinfo','files' => true]) !!}
        <div class="row">
            <div class="input-field col s12 l6">
                <div class="file-field input-field">
                    <div class="btn indigo darken-1">
                        <span>GAMBAR</span>
                        <input class="upload-file" type="file" name="image" required="true" accept="image/x-png, image/gif, image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l6">
                {!! Form::text('judul', null, ['class' => 'validate', 'placeholder' => 'Judul Info']) !!}
                {!! Form::label('icon_telephone', 'Judul') !!}
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l8">
                {!! Form::textarea('isi_info', null, ['class' => 'materialize-textarea']) !!}
                {!! Form::label('Isi Informasi', 'Isi Informasi') !!}
            </div>
        </div>
        <div class="row" id="buttoninfo">
            <button type="submit" name="publish" value="publish" class="waves-effect waves-light btn pink darken-4" onclick="Materialize.toast('Info Berhasil Dipublish', 4000)">PUBLIKASIKAN</button>
            <button type="submit" name="draft" class="waves-effect waves-light btn grey darken-2" onclick="Materialize.toast('Info Disimpan Menjadi Draft', 4000)">DRAFT</button>
        </div>
        
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    /* Attach the form event when jQuery loads. */
$(document).ready(function(e){

/* Handle any form's submit event. */
    $("form").submit(function(e){

        e.preventDefault();                 /* Stop the form from submitting immediately. */
        var continueInvoke = true;          /* Variable used to avoid $(this) scope confusion with .each() function. */

        /* Loop through each form element that has the required="" attribute. */
        $("form input[required]").each(function(){

            /* If the element has no value. */
            if($(this).val() == ""){
                continueInvoke = false;     /* Set the variable to false, to indicate that the form should not be submited. */
            }

        });

        /* Read the variable. Detect any items with no value. */
        if(continueInvoke == true){
            $(this).submit();               /* Submit the form. */
        }

    });

});
</script>
<script>
$('select').material_select();
$(".button-collapse").sideNav();
$('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
selectYears: 15 // Creates a dropdown of 15 years to control year
});
</script>
@endsection