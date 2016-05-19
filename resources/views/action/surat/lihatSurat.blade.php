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
<li class="active"><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
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
                            <th data-field="waktu">Tanggal Pembuatan</th>
                            <th data-field="status">Status</th>
                            <th class="center-align" data-field="action">Action</th>
                        @elseif ($roledatabase === "sekretariat")
                            <th data-field="nama">Nama</th>
                            <th data-field="tipe_surat">Tipe Surat</th>
                            <th data-field="status">Status</th>
                            <th data-field="status">Tanggal Pengajuan</th>
                            <th class="center-align" data-field="action">Action</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                    @if($roledatabase === "mahasiswa")
                        @foreach($surat as $suratt)
                        <tr>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->created_at}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>
                                <div class="center-align">
                                    @if($suratt->status === "Belum Diproses")
                                    <a href="{{action('Controller@editsurat', $suratt->id)}}">
                                        <i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Edit">mode_edit</i>
                                    </a>
                                    @else
                                        <i class="material-icons grey-text text-darken-2">mode_edit</i>
                                    @endif

                                    @if($suratt->status === "Belum Diproses")


                                        <a class="modal-trigger" data-position="top" data-delay="50" data-tooltip="Delete" href="#modal1"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="top" data-delay="50" data-tooltip="Delete" href="#modal1">delete</i></a>

                                        

                                         <div id="modal1" class="modal">
                                          <div class="modal-content">
                                            <h4>Peringatan</h4>
                                            <p>Anda akan menghapus surat, tekan 'YA' untuk melanjutkan, tekan 'TIDAK' untuk membatalkan</p>
                                          </div>
                                          <div class="modal-footer">
                                            
                                             <a href="{{action('Controller@getdaftarsurat')}}" class=" modal-action modal-close waves-effect waves-green btn-flat">TIDAK</a>
                                             <a href="{{action('Controller@hapussurat', $suratt->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">YA</a>
                                          </div>
                                        </div>

                                    @else
                                        <i class="material-icons grey-text text-darken-2">delete</i>
                                    @endif
                                    <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i></a>
                                </div>
                                <!-- Modal Structure For Details-->
                                  <div id="{{$j--}}" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                      <h4>{{$suratt->tipe_surat}}</h4>
                                      <div class="divider"></div>
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
                        </tr>
                        @endforeach
                    @elseif ($roledatabase === "sekretariat")
                        @foreach($suratsekretariat as $suratt)
                        <tr>
                            <td>{{$suratt->nama}}</td>
                            <td>{{$suratt->tipe_surat}}</td>
                            <td>{{$suratt->status}}</td>
                            <td>{{$suratt->updated_at}}</td>
                            <td>
                                <div class="center-align">
                                    <a href class="modal-trigger" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Update">swap_vert</i></a>
                                    <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i></a>
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