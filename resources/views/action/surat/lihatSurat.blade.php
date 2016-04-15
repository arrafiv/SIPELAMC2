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
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
@if($roledatabase === "sekretariat")
<li><a href="{{action('Controller@getdaftarsuratselesai')}}"><span class="pink-text text-darken-4">Daftar Surat Selesai</span></a></li>
@endif
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('isi-sidebar-in-content')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
@if($roledatabase === "sekretariat")
<li><a href="{{action('Controller@getdaftarsuratselesai')}}"><span class="pink-text text-darken-4">Daftar Surat Selesai</span></a></li>
@endif
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Surat</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
            <div class="s12 m4 l8">
                <table id="example" class="bordered highlight" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        @if ($roledatabase === "mahasiswa")
                            <th data-field="tipe_surat">Tipe Surat</th>
                            <th data-field="keperluan">Keperluan</th>
                            <th data-field="status">Status</th>
                            <th data-field="action"></th>
                        @elseif ($roledatabase === "sekretariat")
                            <th data-field="nama">Nama</th>
                            <th data-field="tipe_surat">Tipe Surat</th>
                            <th data-field="keperluan">Keperluan</th>
                            <th data-field="status">Status</th>
                            <th data-field="action"></th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                    @if($roledatabase === "mahasiswa")
                        @foreach($surat as $suratt)
                        <tr>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->keperluan}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>
                                <div class="center-align">
                                    @if($suratt->status === "Belum Diproses")
                                    <a href="{{action('Controller@editsurat', $suratt->id)}}">
                                        <i class="material-icons pink-text text-darken-4">mode_edit</i>
                                    </a>
                                    @else
                                        <i class="material-icons grey-text text-darken-2">mode_edit</i>
                                    @endif

                                    @if($suratt->status === "Belum Diproses")
                                        <a href="{{action('Controller@hapussurat', $suratt->id)}}">
                                            <i class="material-icons pink-text text-darken-4">delete</i>
                                        </a>
                                    @else
                                        <i class="material-icons grey-text text-darken-2">delete</i>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @elseif ($roledatabase === "sekretariat")
                        @foreach($suratsekretariat as $suratt)
                        <tr>
                            <td>{{$suratt->nama}}</td>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->keperluan}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>
                                <div class="center-align">
                                    <a class="modal-trigger btn-flat" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4">swap_vert</i></a>
                                </div>
                                <div id="{{$i++}}" class="modal">
                                    <div class="modal-content">
                                      {!! Form::model($suratt, ['action' => ['Controller@updatestatussurat', $suratt->id]]) !!}
                                        <div class="input-field col s12">
                                        <select name="status" >
                                          <option value="" disabled selected>Choose your option</option>
                                          <option value="Diproses">Diproses</option>
                                          <option value="Selesai">Selesai</option>
                                        </select>
                                        <label>UBAH STATUS SURAT</label>
                                      </div>
                                      <div class="row">
                                         <button class="waves-effect waves-light btn pink darken-4" id="buttonmodal">SUBMIT</button>
                                          <a class="modal-action modal-close btn grey darken-1" id="buttonmodal">Close</a>
                                      </div>
                                    {!! Form::close() !!}
                                    </div>
                                  </div>
                            </td>
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
                        targets: [ 0, 1, 2 ],
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
</script>
@endsection

@elseif ($roledatabase === "sekretariat")
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
@endif