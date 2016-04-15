@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')

<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinselesai')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>

@endsection

@section('isi-sidebar-in-content')

<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinselesai')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>

@endsection

@section('styles')
<style type="text/css">
    #buttonmodal{
        margin-top: 10em;
    }
</style>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Ijin Kegiatan Selesai</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
    <table id="example" class="bordered highlight" cellspacing="0" width="100%">
    <thead>
            <tr>
            
                <th data-field="nama">Nama</th>
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
                <th data-field="status">Status</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach($daftarizinsekre as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama}}</td>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->deskripsi}}</td>
                <td>{{$daftarizinn->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    $(".button-collapse").sideNav();
    $('.dropdown-button').dropdown({
          inDuration: 300,
          outDuration: 225,
          constrain_width: false, // Does not change width of dropdown to that of the activator
          hover: true, // Activate on hover
          gutter: 0, // Spacing from edge
          belowOrigin: false, // Displays dropdown below the button
          alignment: 'left' // Displays dropdown with edge aligned to the left of button
        }
    );
    $('select').material_select();
</script>
@endsection














