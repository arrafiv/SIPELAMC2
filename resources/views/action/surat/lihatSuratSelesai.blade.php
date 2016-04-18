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
                            <th data-field="status">Status</th>
                            <th class="center-align" data-field="status">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratsekretariat as $suratt)
                        <tr>
                            <td>{{$suratt->nama}}</td>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>
                                <div class="center-align">
                                    <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Info">info_outline</i></a>
                                </div>
                                  <!-- Modal Structure For Details-->
                                  <div id="{{$j--}}" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                      <h4>{{$suratt->nama}}</h4>
                                      <div class="divider"></div>
                                      <br>
                                      <h6 class="pink-text text-darken-4">NPM</h6>
                                      <p>{{$suratt->npm}}</p>
                                      <br>
                                      <h6 class="pink-text text-darken-4">Tipe Surat</h6>
                                      <p>{{$suratt->tipe_surat}}</p>
                                      <br>
                                      <h6 class="pink-text text-darken-4">Keperluan</h6>
                                      <p>{{$suratt->keperluan}}</p>
                                      <br>
                                      <h6 class="pink-text text-darken-4">Kontak</h6>
                                      <p>{{$suratt->email}} | {{$suratt->no_hp}}</p> 
                                    </div>
                                    <div class="modal-footer">
                                      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                                    </div>
                                  </div>
                            </td>
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