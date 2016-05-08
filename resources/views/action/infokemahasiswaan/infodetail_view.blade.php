@extends('layouts.master')
@section('styles')
<style type="text/css">
#rownav{
background-color: #714588;
margin-left: 0;
height: 257px;
}
#rownav #colnav{
padding: 0;
}
#isi_info{
font-size: 18px;
}
.container{
position: absolute;
top: 6em;
left: 0;
right: 0;
margin-left: auto;
margin-right: auto;
}
#breadcrumb1{
font-weight: 200;
}
</style>
@endsection
@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@showcreateinfo')}}"><span class="pink-text text-darken-4">Buat Info</span></a></li>
<li><a href="{{action('Controller@showinfokemahasiswaan')}}"><span class="pink-text text-darken-4">Info Kemahasiswaan</span></a></li>
<li><a href="{{action('Controller@getdaftarinfo')}}"><span class="pink-text text-darken-4">Published</span></a></li>
<li><a href="{{action('Controller@getdaftarinfodraft')}}"><span class="pink-text text-darken-4">Draft</span></a></li>
@endsection
@section('content')
<div class="rowatasjudul">
    <div class="row" id="rownav">
        <div class="col s12 l8" id="colnav">
        </div>
    </div>
</div>
<div class="container">
    <div class="col s12">
        @if($roledatabase === "sekretariat")
        <a href="{{action('Controller@showinfokemahasiswaan')}}" class="breadcrumb" id="breadcrumb1">Info Kemahasiswaan</a>
        @else
        <a href="{{action('Controller@showinfo_kemahasiswaan')}}" class="breadcrumb" id="breadcrumb1">Info Kemahasiswaan</a>
        @endif
        <span class="breadcrumb" id="breadcrumb2">{{$judul}}</span>
    </div>
    <div class="row" id="info">
        
        <div class="center">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="{{URL::to('images/info_kemahasiswaan/' . $gambar)}}">
                </div>
                <div class="card-content">
                    <h1 class="grey-text">{{$judul}}</h1>
                    <p id="isi_info" class="grey-text">{{$isi_info}}</p>
                    <br>
                    <p id="time" class="grey-text right">{{$created_at}}</p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(".button-collapse").sideNav();
</script>
@endsection