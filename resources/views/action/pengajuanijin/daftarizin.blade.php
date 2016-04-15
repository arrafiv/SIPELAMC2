@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "sekretariat")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinselesai')}}"><span class="pink-text text-darken-4">Ijin Kegiatan Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "manajer akademik")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinlist')}}"><span class="pink-text text-darken-4">List Pengajuan Ijin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endif
@endsection

@section('isi-sidebar-in-content')
@if($roledatabase === "mahasiswa")
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "sekretariat")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinselesai')}}"><span class="pink-text text-darken-4">Ijin Kegiatan Selesai</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($roledatabase === "manajer akademik")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="{{action('Controller@getdaftarizinlist')}}"><span class="pink-text text-darken-4">List Pengajuan Ijin</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endif
@endsection

@section('styles')
<style type="text/css">
   /* #buttonmodal{
        margin-top: 10em;
    }*/
</style>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Ijin Kegiatan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
    <table id="example" class="bordered highlight" cellspacing="0" width="100%">
        <thead>
            <tr>
            @if($roledatabase === "mahasiswa")
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
                <th data-field="status">Status</th>
                <th data-field="action"></th>
            @elseif($roledatabase === "sekretariat")
                <th data-field="nama">Nama</th>
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
                <th data-field="status">Status</th>
                <th class="center-align" data-field="Action"></th>
            @elseif($roledatabase === "manajer akademik")
                <th data-field="nama">Nama</th>
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
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
                <td>{{$daftarizinn->deskripsi}}</td>
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <div class="center-align">
                        @if($daftarizinn->status === "Belum Diproses")
                        <a href="{{action('Controller@editizin', $daftarizinn->id)}}">
                            <i class="material-icons pink-text text-darken-4">mode_edit</i>
                        </a>
                        @else
                            <i class="material-icons grey-text text-darken-2">mode_edit</i>
                        @endif

                        @if($daftarizinn->status === "Belum Diproses")
                        <a href="{{action('Controller@hapusizin', $daftarizinn->id)}}">
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
            @foreach($daftarizinsekre as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama}}</td>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->deskripsi}}</td>
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <div class="center-align">
                        <a class="modal-trigger btn-flat" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4">swap_vert</i></a>
                    </div>
                    <div id="{{$i++}}" class="modal">
                        <div class="modal-content">
                          {!! Form::model($daftarizinn, ['action' => ['Controller@updatestatusizin', $daftarizinn->id]]) !!}
                            <div class="row">
                                 <div class="input-field col s12">
                                <select name="status" >
                                  <option value="" disabled selected>Choose your option</option>
                                  <!-- <option value="Belum Diproses">Belum Diproses</option> -->
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
                </td>
            </tr>
            @endforeach
        @elseif ($roledatabase === "manajer akademik")
            @foreach($daftarizinmanajer as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama}}</td>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->deskripsi}}</td>
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <div class="center-align">
                        <a class="modal-trigger btn-flat" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4">swap_vert</i></a>
                    </div>
                    <div id="{{$i++}}" class="modal">
                        <div class="modal-content">
                          {!! Form::model($daftarizinn, ['action' => ['Controller@updatestatusizin', $daftarizinn->id]]) !!}
                            <div class="input-field col s12">
                            <select name="status" >
                              <option value="" disabled selected>Choose your option</option>
                              <option value="Disetujui">Disetujui</option>
                              <option value="Tidak Disetujui">Tidak Disetujui</option>
                            </select>
                            <label>UBAH STATUS SURAT IZIN</label>
                          </div>
                          <div class="row">
                             <button class="waves-effect waves-light btn pink darken-4" id="buttonmodal">SUBMIT</button>
                              <a class="modal-action modal-close btn grey darken-1" id="buttonmodal">Close</a>
                          </div>
                        {!! Form::close() !!}
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














