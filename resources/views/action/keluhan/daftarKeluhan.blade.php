@extends('layouts.mastercontent')
@extends('elements.element')
@section('styles')
<style type="text/css">
#buttonmodal{
margin-top: 5em;
}
</style>
@endsection
@section('isi-side-nav')
@if($roledatabase === "mahasiswa" or $roledatabase === "staff")
<li><a href="{{action('Controller@getcreatekeluhan')}}"><span class="pink-text text-darken-4">Ajukan Keluhan</span></a></li>
@endif
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
@if($roledatabase === "manajer akademik")
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diterima</span></a></li>
@elseif($roledatabase === "manajer infrastruktur")
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diterima</span></a></li>
@elseif($roledatabase === "manajer sarpras")
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diterima</span></a></li>
@endif
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('isi-sidebar-in-content')
@if($roledatabase === "mahasiswa" or $roledatabase === "staff")
<li><a href="{{action('Controller@getcreatekeluhan')}}"><span class="pink-text text-darken-4">Ajukan Keluhan</span></a></li>
@endif
<li class="active"><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
@if($roledatabase === "manajer akademik")
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diterima</span></a></li>
@elseif($roledatabase === "manajer infrastruktur")
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diterima</span></a></li>
@elseif($roledatabase === "manajer sarpras")
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diterima</span></a></li>
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
                        @if ($roledatabase === "mahasiswa" or $roledatabase === "staff")
                        <th data-field="divisi">Tujuan</th>
                        <th data-field="keluhan">Keluhan</th>
                        <th data-field="status">Status</th>
                        <th class="center-align" data-field="action">Action</th>
                        @else
                        <th data-field="prioritas">Prioritas</th>
                        <th data-field="divisi">Pembuat</th>
                        <th data-field="keluhan">Keluhan</th>
                        <th data-field="status">Status</th>
                        <th data-field="status">Tanggal Pengajuan</th>
                        <th class="center-align" data-field="action">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if($roledatabase === "mahasiswa" or $roledatabase === "staff")
                    @foreach($keluhanmahasiswa as $keluhann)
                    <tr>
                        <td>{{$keluhann->divisi}}</td>
                        <td>{{$keluhann->judul}}</td>
                        <td>{{$keluhann->status}}</td>
                        <td>
                            <div class="center-align">
                                @if($keluhann->status === "Belum Diproses")
                                <a href="{{action('Controller@editkeluhan', $keluhann->id)}}">
                                    <i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Edit">mode_edit</i>
                                </a>
                                @else
                                <i class="material-icons grey-text text-darken-2">mode_edit</i>
                                @endif
                                @if($keluhann->status === "Belum Diproses")
                                <a href class="modal-trigger" data-position="top" data-delay="50" data-tooltip="Delete" data-target="{{$k}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="top" data-delay="50" data-tooltip="Delete" href="#modal1">delete</i></a>
                                <div id="{{$k--}}" class="modal">
                                    <div class="modal-content">
                                        <h4>Peringatan</h4>
                                        <p>Anda akan menghapus keluhan, tekan 'YA' untuk melanjutkan, tekan 'TIDAK' untuk membatalkan</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">TIDAK</a>
                                        <a href="{{action('Controller@hapuskeluhan', $keluhann->id)}}" class=" modal-action modal-close waves-effect waves-green btn-flat">YA</a>
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
                                    <h4>{{$keluhann->judul}}</h4>
                                    <div class="divider"></div>
                                    <br>
                                    <h6 class="pink-text text-darken-4">Deskripsi</h6>
                                    <p>{{$keluhann->keluhan}}</p>
                                    <br>
                                    <h6 class="pink-text text-darken-4">Kontak</h6>
                                    <p>{{$keluhann->email}}</p>
                                    <p>{{$keluhann->no_hp}}</p>
                                    <br>
                                    <h6 class="pink-text text-darken-4">Gambar</h6>
                                    <p><img src="{{URL::to('images/keluhan/' . $keluhann->gambar)}}"></p>
                                    </div>
                                    <div class="modal-footer">
                                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @foreach($keluhantertuju as $keluhann)
                    <tr>
                        <td>{{$keluhann->prioritas}}</td>
                        <td>{{$keluhann->nama}}</td>
                        <td>{{$keluhann->judul}}</td>
                        <td>{{$keluhann->status}}</td>
                        <td>{{$keluhann->updated_at}}</td>
                        <td>
                            <div class="center-align">
                                <a href class="modal-trigger" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Update">swap_vert</i></a>
                                <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i></a>
                            </div>
                            <!-- Modal Structure For Update Status-->
                            <div id="{{$i++}}" class="modal">
                                    <div class="modal-content">
                                      {!! Form::model($keluhann, ['action' => ['Controller@updatestatuskeluhan', $keluhann->id]]) !!}
                                      <div class="row">  
                                        <div class="input-field col s12">
                                            <select name="status" >
                                              <option value="" disabled selected>Choose your option</option>
                                              <option value="Diterima">Diterima</option>
                                              <option value="Ditolak">Ditolak</option>
                                            </select>
                                            <label>UBAH STATUS KELUHAN</label>
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
                                    <h4>{{$keluhann->nama}}</h4>
                                    <div class="divider"></div>
                                    <br>
                                    <h6 class="pink-text text-darken-4">NPM</h6>
                                    <p>{{$keluhann->npm}}</p>
                                    <br>
                                    <h6 class="pink-text text-darken-4">Keluhan</h6>
                                    <p>{{$keluhann->judul}}</p>
                                    <p>{{$keluhann->keluhan}}</p>
                                    <br>
                                    <h6 class="pink-text text-darken-4">Gambar</h6>
                                    <p><img src="{{URL::to('images/keluhan/' . $keluhann->gambar)}}"></p>
                                    <br>
                                    <h6 class="pink-text text-darken-4">Kontak</h6>
                                    <p>{{$keluhann->email}}</p>
                                    <p>{{$keluhann->no_hp}}</p>
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
@if ($roledatabase === "mahasiswa")
@section('script')
<script>
$(document).ready(function() {
$('#example').DataTable( {
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
</script>
@endsection
@else
@section('script')
<script>
$(document).ready(function() {
$('#example').DataTable( {
columnDefs: [
{
targets: [ 0, 1, 2, 3 ],
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