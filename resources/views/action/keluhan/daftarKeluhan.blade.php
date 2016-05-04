@extends('layouts.mastercontent')

@extends('elements.element')

@section('styles')
<style type="text/css">
    #buttonmodal{
        margin-top: 10em;
    }
</style>
@endsection

@section('isi-side-nav')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getcreatekeluhan')}}"><span class="pink-text text-darken-4">Ajukan Keluhan</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
@if($roledatabase === "sekretariat")
<li><a href="#"><span class="pink-text text-darken-4">Daftar Keluhan Selesai</span></a></li>
@endif
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('isi-sidebar-in-content')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getcreatekeluhan')}}"><span class="pink-text text-darken-4">Ajukan Keluhan</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
@if($roledatabase === "sekretariat")
<li><a href="#"><span class="pink-text text-darken-4">Daftar Keluhan Selesai</span></a></li>
@endif
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Keluhan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
            <div class="s12 m4 l8">
                <table id="example" class="bordered highlight" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        @if ($roledatabase === "mahasiswa")
                            <th data-field="divisi">Tujuan</th>
                            <th data-field="keluhan">Keluhan</th>
                            <th data-field="status">Status</th>
                            <th class="center-align" data-field="action">Action</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                    @if($roledatabase === "mahasiswa")
                        @foreach($keluhan as $keluhann)
                        <tr>
                            <td>{{$keluhann->divisi}}</td>
                            <td>{{$keluhann->keluhan}}</td>
                            <td>{{$keluhann->status}}</td>

                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection

@if ($roledatabase === "mahasiswa")
@section('script')
<script>
    $(document).ready(function() {
            $('#example').DataTable( {
                columnDefs: [
                    {
                        targets: [ 0, 1],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            } );
        } );
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
    $('.modal-trigger').leanModal();
</script>
@endsection

@elseif ($roledatabase === "sekretariat")
@section('script')
<script>
    $(document).ready(function() {
            $('#example').DataTable( {
                columnDefs: [
                    {
                        targets: [ 0, 1, 2 ],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            } );
            $('.tooltipped').tooltip({delay: 50});
        } );
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
    $('.modal-trigger').leanModal();
    $('select').material_select();
</script>
@endsection
@endif