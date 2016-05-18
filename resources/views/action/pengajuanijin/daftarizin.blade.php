@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Izin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "sekretariat")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinselesai')}}"><span class="pink-text text-darken-4">Izin Kegiatan Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "manajer akademik")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinlist')}}"><span class="pink-text text-darken-4">List Pengajuan Izin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endif
@endsection

@section('isi-sidebar-in-content')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Izin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "sekretariat")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinselesai')}}"><span class="pink-text text-darken-4">Izin Kegiatan Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "manajer akademik")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Izin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinlist')}}"><span class="pink-text text-darken-4">List Pengajuan Izin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endif
@endsection

@section('styles')
<style type="text/css">
    #buttonmodal{
        margin-top: 5em;
    }
</style>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Izin Kegiatan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
    <div class="s12 m4 l8">
    <table id="example2" class="bordered highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
            @if($roledatabase === "mahasiswa")
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="status">Status</th>
                <th class="center-align" data-field="action">Action</th>
            @elseif($roledatabase === "sekretariat")
                <th data-field="nama">Nama</th>
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="tanggal_pengajuan">Tanggal Pengajuan</th>
                <th data-field="status">Status</th>
                <th class="center-align" data-field="Action">Action</th>
            @elseif($roledatabase === "manajer akademik")
                <th data-field="nama">Nama</th>
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="tanggal_pengajuan">Tanggal Pengajuan</th>
                <th data-field="status">Status</th>
                <th class="center-align" data-field="Action">Action</th>
            @endif
            </tr>
        </thead>
        <tbody>
        @if($roledatabase === "mahasiswa")
            @foreach($daftarizin as $daftarizinn)
            <tr>
                
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <div class="center-align">
                        @if($daftarizinn->status === "Belum Diproses")
                        <a href="{{action('Controller@editizin', $daftarizinn->id)}}">
                            <i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Edit">mode_edit</i>
                        </a>
                        @else
                            <i class="material-icons grey-text text-darken-2">mode_edit</i>
                        @endif

                        @if($daftarizinn->status === "Belum Diproses")
                          <a class="modal-trigger" data-position="top" data-delay="50" data-tooltip="Delete" href="#modal1"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="top" data-delay="50" data-tooltip="Delete" href="#modal1">delete</i></a>


                           <div id="modal1" class="modal">
                            <div class="modal-content">
                              <h4>Peringatan</h4>
                              <p>Anda akan menghapus izin, tekan 'YA' untuk melanjutkan, tekan 'TIDAK' untuk membatalkan</p>
                            </div>
                            <div class="modal-footer">
                               <a href="{{action('Controller@getdaftarizin')}}" class=" modal-action modal-close waves-effect waves-green btn-flat">TIDAK</a>
                               <a href="{{action('Controller@hapusizin', $daftarizinn->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">YA</a>
                            </div>
                          </div>
                        @else
                            <i class="material-icons grey-text text-darken-2">delete</i>
                        @endif
                    <!-- Modal Trigger For Details -->
                        <a href class="modal-trigger" data-target="{{$j}}">
                        <i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i>
                        </a>
                    </div>
                    <!-- Modal Structure For Details-->
                      <div id="{{$j--}}" class="modal modal-fixed-footer">
                        <div class="modal-content">
                          <h4>{{$daftarizinn->nama_kegiatan}}</h4>
                          <div class="divider"></div>
                          <br>
                          <h6 class="pink-text text-darken-4">Deskripsi</h6>
                          <p>{{$daftarizinn->deskripsi}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Waktu Kegiatan</h6>
                          <p>{{$daftarizinn->tanggal_mulai_kegiatan}} - {{$daftarizinn->tanggal_selesai_kegiatan}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Kontak</h6>
                          <p>{{$daftarizinn->email}} | {{$daftarizinn->no_hp}}</p>
                          <h6 class="pink-text text-darken-4">File</h6>
                          <p><a href="{{$daftarizinn->file}}">{{$daftarizinn->file}}</a></p> 
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                        </div>
                      </div>                    
                </td>
            </tr>
            @endforeach
        @elseif ($roledatabase === "sekretariat")
            @foreach($daftarizinsekre as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama}}</td>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->updated_at}}</td>
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <div class="center-align">
                        <a href class="modal-trigger" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Update">swap_vert</i></a>
                        <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i></a>
                    </div>

                    <!-- Modal Structure For Update Status-->
                    <div id="{{$i++}}" class="modal">
                        <div class="modal-content">
                          {!! Form::model($daftarizinn, ['action' => ['Controller@updatestatusizin', $daftarizinn->id]]) !!}
                            <div class="row">
                                 <div class="input-field col s12">
                                <select name="status" >
                                  <option value="" disabled selected>Choose your option</option>
                                  <option value="Diproses">Diproses</option>
                                  <option value="Selesai">Selesai</option>
                                </select>
                                <label>UBAH STATUS SURAT IZIN</label>
                              </div>
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
                          <h4>{{$daftarizinn->nama_kegiatan}}</h4>
                          <div class="divider"></div>
                          <br>
                          <h6 class="pink-text text-darken-4">Pemohon</h6>
                          <p>{{$daftarizinn->nama}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Deskripsi</h6>
                          <p>{{$daftarizinn->deskripsi}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Waktu Kegiatan</h6>
                          <p>{{$daftarizinn->tanggal_mulai_kegiatan}} - {{$daftarizinn->tanggal_selesai_kegiatan}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Kontak</h6>
                          <p>{{$daftarizinn->email}} | {{$daftarizinn->no_hp}}</p>
                          <h6 class="pink-text text-darken-4">File</h6>
                          <p><a href="{{$daftarizinn->file}}">{{$daftarizinn->file}}</a></p> 
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                        </div>
                      </div>
                </td>
            </tr>
            @endforeach
        @elseif ($roledatabase === "manajer akademik")
            @foreach($daftarizinmanajer as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama}}</td>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->updated_at}}</td>
                <!-- <td>{{$daftarizinn->deskripsi}}</td> -->
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <div class="center-align">
                        <a href class="modal-trigger" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Update">swap_vert</i></a>
                        <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i></a>
                    </div>

                    <!-- Modal Structure For Update Status-->
                    <div id="{{$i++}}" class="modal">
                        <div class="modal-content">
                          {!! Form::model($daftarizinn, ['action' => ['Controller@updatestatusizin', $daftarizinn->id]]) !!}
                          <div class="row">
                            <div class="input-field col s12">
                              <select name="status" >
                                <option value="" disabled selected>Choose your option</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Tidak Disetujui">Tidak Disetujui</option>
                              </select>
                              <label>UBAH STATUS SURAT IZIN</label>
                            </div>
                          </div>
                          <div class="row">
                              <div class="input-field col s12 l12">
                                  {!! Form::textarea('pesan', null, ['class' => 'materialize-textarea', 'required' => "", 'aria-required' => 'true']) !!}
                                  {!! Form::label('pesan', 'Pesan Kepada Mahasiswa') !!}
                              </div>
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
                          <h4>{{$daftarizinn->nama_kegiatan}}</h4>
                          <div class="divider"></div>
                          <br>
                          <h6 class="pink-text text-darken-4">Pemohon</h6>
                          <p>{{$daftarizinn->nama}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Deskripsi</h6>
                          <p>{{$daftarizinn->deskripsi}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Waktu Kegiatan</h6>
                          <p>{{$daftarizinn->tanggal_mulai_kegiatan}} - {{$daftarizinn->tanggal_selesai_kegiatan}}</p>
                          <br>
                          <h6 class="pink-text text-darken-4">Kontak</h6>
                          <p>{{$daftarizinn->email}} | {{$daftarizinn->no_hp}}</p>
                          <h6 class="pink-text text-darken-4">File</h6>
                          <p><a href="{{$daftarizinn->file}}">{{$daftarizinn->file}}</a></p> 
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                        </div>
                      </div>
                </td>
    
            </tr>
            @endforeach
        @endif  
        </tbody>
    </table>
</div>
</div>
</div>
@endsection

@section('script')
@if ($roledatabase === "mahasiswa")
<script>
    $(document).ready(function() {
            $('#example2').DataTable( {
                columnDefs: [
                    {
                        targets: [ 0, 1, 2],
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
@else
<script>
    $(document).ready(function() {
            $('#example2').DataTable( {
                columnDefs: [
                    {
                        targets: [ 0, 1, 2, 3],
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
@endif
@endsection














