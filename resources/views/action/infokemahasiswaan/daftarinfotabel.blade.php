@extends('layouts.mastercontent')
@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@showcreateinfo')}}"><span class="pink-text text-darken-4">Buat Info</span></a></li>
<li><a href="{{action('Controller@showinfokemahasiswaan')}}"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></a></li>
<li><a href="{{action('Controller@getdaftarinfo')}}"><span class="pink-text text-darken-4">Published</span></a></li>
<li><a href="{{action('Controller@getdaftarinfodraft')}}"><span class="pink-text text-darken-4">Draft</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@showcreateinfo')}}"><span class="pink-text text-darken-4">Buat Info</span></a></li>
<li><a href="{{action('Controller@showinfokemahasiswaan')}}"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></a></li>
<li><a href="{{action('Controller@getdaftarinfo')}}"><span class="pink-text text-darken-4">Published</span></a></li>
<li><a href="{{action('Controller@getdaftarinfodraft')}}"><span class="pink-text text-darken-4">Draft</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Info Kemahasiswaan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
            <div class="s12 m4 l8">
                 <table id="example" class="bordered highlight" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th data-field="nama">Gambar</th>
                            <th data-field="tipe_surat">Judul</th>
                            <th data-field="tanggal">Tanggal Publikasi</th>
                            <th data-field="status">Status</th>
                            <th class="center-align" data-field="status">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $infokemahasiswaan)
                        <tr>
                            <td>{{$infokemahasiswaan->gambar}}</td>
                            <td>{{$infokemahasiswaan->judul}}</td>
                            <td>{{$infokemahasiswaan->updated_at}}</td>
                            <td>{{$infokemahasiswaan->status}}</td>
                            <td>
                                <div class="center-align">
                                    <a href="{{action('Controller@editinfo', $infokemahasiswaan->id)}}">
			                            <i class="material-icons pink-text text-darken-4 tooltipped" data-position="left" data-delay="50" data-tooltip="Edit">mode_edit</i>
			                        </a>
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
                        targets: [ 0, 1, 2, 3],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            } );
            $('.tooltipped').tooltip({delay: 50});
        } );
    $(".button-collapse").sideNav();
</script>
@endsection