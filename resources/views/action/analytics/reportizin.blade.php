@extends('layouts.mastercontent')
@extends('elements.element')
@if($roledatabase === "sekretariat")
@section('isi-side-nav')
<li><a href="{{action('Controller@showreportsurat')}}"><span class="pink-text text-darken-4">Surat</span></a></li>
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@showreportsurat')}}"><span class="pink-text text-darken-4">Surat</span></a></li>
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
@endsection
@elseif($roledatabase === "manajer akademik")
@section('isi-side-nav')
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
<li><a href="{{action('Controller@showreportkeluhan')}}"><span class="pink-text text-darken-4">Keluhan</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
<li><a href="{{action('Controller@showreportkeluhan')}}"><span class="pink-text text-darken-4">Keluhan</span></a></li>
@endsection
@endif
@section('styles')
<style type="text/css">
body{
    background-color: #eeeeee;
}
#rownav{
background-color: #714588;
margin-left: 0;
height: 150px;
margin-bottom: -1em;
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
#barchart_material{
padding: 2em;
}
#columnchart_material{
padding: 2em;
}
#rownav2{
background-color: #880e4f;
margin-left: 0;
height: 55px;
margin-bottom: -1em;
}
#rownav2 #colnav2{
padding: 0;
}
#judulinfo2{
margin-left: 1.5em;
margin-top: .5 em;
font-weight: 200;
}
#card{
margin-left: 1em;
margin-right: 1em;
margin-top: 1em;
}
.container{
    margin-top: 3em;
}
</style>
@endsection
@extends('elements.element')
@section('content')
<div class="rowatasjudul">
    <div class="row" id="rownav">
        <div class="col s12 l8" id="colnav">
            <h4 id="judulinfo" class="white-text">Analisis dan Laporan</h4>
        </div>
    </div>
</div>
<div class="rowatasjudul">
    <div class="row" id="rownav2">
        <div class="col s12 l8" id="colnav2">
            <h5 id="judulinfo2" class="white-text">Pengajuan Izin</h5>
        </div>
    </div>
</div>
<div class="container">
    <div class="izin">
    @if($roledatabase === "sekretariat")
        <div class="row">
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>Total</strong></h6>
                    <div class="card-panel blue">
                        <h1 class="center-align white-text">{!! $izinCountAll !!}</h1>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>{!! $thisMonthString!!}</strong></h6>
                    <div class="card-panel amber">
                        <h1 class="center-align white-text">{!! $izinThisMonth !!}</h1>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>Butuh Penyelesaian</strong></h6>
                    <div class="card-panel red">
                        <h1 class="center-align white-text">{!! $izinDisetujui !!}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l12 s12">
                <div class="card">
                    <div id="columnchart_material" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        @elseif($roledatabase === "manajer akademik")
        <div class="row">
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>Total</strong></h6>
                    <div class="card-panel blue">
                        <h1 class="center-align white-text">{!! $izinCountAll !!}</h1>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>{!! $thisMonthString!!}</strong></h6>
                    <div class="card-panel amber">
                        <h1 class="center-align white-text">{!! $izinThisMonth !!}</h1>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>Belum Diproses</strong></h6>
                    <div class="card-panel red">
                        <h1 class="center-align white-text">{!! $izinBelumDiproses !!}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l12 s12">
                <div class="card">
                    <div id="columnchart_material" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
var data = google.visualization.arrayToDataTable([
['Bulan', 'Jumlah'],
@foreach($izinCountPerBulan as $izin)
['{{$izin->bulan}}', {{$izin->jumlah}}],
@endforeach
]);
var options = {
chart: {
title: 'Jumlah Pengajuan Izin',
subtitle: 'Per Bulan',
}
};
var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
chart.draw(data, options);
}
</script>
<script>
$(document).ready(function () {
$('.slider').slider({
full_width: true
});
$(".button-collapse").sideNav();
});
</script>
@endsection