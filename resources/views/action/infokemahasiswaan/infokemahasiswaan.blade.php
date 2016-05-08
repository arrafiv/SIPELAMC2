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
@section('styles')
<style type="text/css">
#rownav{
background-color: #714588;
margin-left: 0;
height: 150px;
}
#rownav #colnav{
padding: 0;
}
#judulinfo{
margin-left: 1em;
margin-top: 2em;
}
#isi_info{
font-size: 12px;
}
#time{
font-size: 10px;
font-weight: 100;
}
</style>
@endsection
@extends('elements.element')
@section('content')
<div class="rowatasjudul">
    <div class="row" id="rownav">
        <div class="col s12 l8" id="colnav">
            <h4 id="judulinfo" class="white-text">Info Kemahasiswaan</h4>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        @foreach($info as $infokemahasiswaan)
        <div class="col s12 m6 l4">
            <div class="card medium hoverable grey lighten-1">
                <div class="card-image">
                    <img src="{{URL::to('images/info_kemahasiswaan/' . $infokemahasiswaan->gambar)}}">
                </div>
                <div class="card-content">
                    <a href="{{action('Controller@showinfo_kemahasiswaan_detail', $infokemahasiswaan->id)}}">
                    <span class="card-title white-text truncateoneline">{{$infokemahasiswaan->judul}}</span>
                    </a>
                    <p id="isi_info" class="truncate white-text">{{$infokemahasiswaan->isi_info}}</p>
                    <br>
                    <p id="time" class="white-text right">{{$infokemahasiswaan->created_at}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row right">{!! $info->links() !!}</div>
</div>
@endsection
@section('script')
<script>
$(".button-collapse").sideNav();
</script>
@endsection