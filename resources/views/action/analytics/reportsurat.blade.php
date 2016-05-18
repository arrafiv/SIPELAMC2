@extends('layouts.mastercontent')
@extends('elements.element')
@if($roledatabase == "sekretariat")
@section('isi-side-nav')
<li><a href="{{action('Controller@showreportsurat')}}"><span class="pink-text text-darken-4">Surat</span></a></li>
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@showreportsurat')}}"><span class="pink-text text-darken-4">Surat</span></a></li>
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
@endsection
@else
@section('isi-side-nav')
<li><a href="{{action('Controller@showreportsurat')}}"><span class="pink-text text-darken-4">Surat</span></a></li>
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@showreportsurat')}}"><span class="pink-text text-darken-4">Surat</span></a></li>
<li><a href="{{action('Controller@showreportizin')}}"><span class="pink-text text-darken-4">Izin</span></a></li>
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
            <h5 id="judulinfo2" class="white-text">Permohonan Surat</h5>
        </div>
    </div>
</div>
<div class="container">
    <div class="surat">
        <div class="row">
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>Total</strong></h6>
                    <div class="card-panel blue">
                        <h1 class="center-align white-text">{!! $suratCountAll !!}</h1>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>{!! $thisMonthString!!}</strong></h6>
                    <div class="card-panel amber">
                        <h1 class="center-align white-text">{!! $suratCountThisMonth !!}</h1>
                    </div>
                </div>
            </div>
            <div class="col l4 s12">
                <div class="card" id="card">
                    <br>
                    <h6 class="center-align"><strong>Belum Diproses</strong></h6>
                    <div class="card-panel red">
                        <h1 class="center-align white-text">{!! $suratCountBelumDiproses !!}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l12 s12">
                <div class="card">
                    <div id="barchart_material" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Bulan', 'Jumlah'],
@foreach($suratCountPerBulan as $surat)
['{{$surat->bulan}}', {{$surat->jumlah}}],
@endforeach
]);
var options = {
chart: {
title: 'Jumlah Permohonan Surat',
subtitle: 'Per Bulan',
},
bars: 'vertical' // Required for Material Bar Charts.
};
var chart = new google.charts.Bar(document.getElementById('barchart_material'));
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