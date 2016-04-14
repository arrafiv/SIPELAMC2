@extends('layouts.mastercontent')

@extends('elements.elementadmin')
@section('isi-side-nav')
<li><a href="{{action('Controller@getdaftarizinadmin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getdaftarizinadmin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Ijin Kegitatan</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
    <table class="highlight">
        <thead>
            <tr>
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
                <th data-field="deskripsi">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($daftarizinadmin as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->deskripsi}}</td>
                <td>
                    <a class='dropdown-button btn' href='#' data-activates='dropdown1'>{{$daftarizinn->status}}</a>
                    <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">Diproses</a></li>
                    <li class="divider"></li>
                    <li><a href="#!">Selesai</a></li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection

@section('script')
<script>
    $(".button-collapse").sideNav();
    
    
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
</script>



@endsection

