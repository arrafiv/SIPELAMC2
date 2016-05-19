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
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
<li><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diproses</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getdaftarkeluhan')}}"><span class="pink-text text-darken-4">Daftar Keluhan</span></a></li>
<li class="active"><a href="{{action('Controller@getdaftarkeluhandiproses')}}"><span class="pink-text text-darken-4">Daftar Keluhan Diproses</span></a></li>
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
                        <th data-field="prioritas">Prioritas</th>
                        <th data-field="divisi">Pembuat</th>
                        <th data-field="keluhan">Keluhan</th>
                        <th data-field="status">Status</th>
                        <th class="center-align" data-field="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keluhandiproses as $keluhann)
                    <tr>
                        <td>{{$keluhann->prioritas}}</td>
                        <td>{{$keluhann->nama}}</td>
                        <td>{{$keluhann->judul}}</td>
                        <td>{{$keluhann->status}}</td>
                        
                    <td>
                        <div class="center-align">
                            <a href class="modal-trigger" data-target="{{$j}}"><i class="material-icons pink-text text-darken-4 tooltipped" data-position="right" data-delay="50" data-tooltip="Info">info_outline</i></a>
                        
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