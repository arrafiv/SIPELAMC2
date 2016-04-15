@extends('layouts.mastercontent')

@extends('elements.element')

@section('isi-side-nav')
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="{{action('Controller@getdaftarsuratselesai')}}"><span class="pink-text text-darken-4">Daftar Surat Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="{{action('Controller@getdaftarsuratselesai')}}"><span class="pink-text text-darken-4">Daftar Surat Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Surat Selesai</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
            <div class="s12 m4 l8">
                 <table id="example" class="bordered highlight" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th data-field="nama">Nama</th>
                            <th data-field="tipe_surat">Tipe Surat</th>
                            <th data-field="keperluan">Keperluan</th>
                            <th data-field="status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratsekretariat as $suratt)
                        <tr>
                            <td>{{$suratt->nama}}</td>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->keperluan}}</td>
                            <td>{{$suratt->status}}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
            $('#example').DataTable( {
                columnDefs: [
                    {
                        targets: [ 0, 1, 2, 3, 4 ],
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
    $('select').material_select();
</script>
@endsection