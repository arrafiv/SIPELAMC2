@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
@if($usernameSSO === "kevin.mahendra")
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($usernameSSO === "rafida.fatimatuzzahra")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endif
@endsection

@section('isi-sidebar-in-content')
@if($usernameSSO === "kevin.mahendra")
<li><a href="{{action('Controller@getcreateizin')}}"><span class="pink-text text-darken-4">Buat Pengajuan Ijin</span></a></li>
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@elseif($usernameSSO === "rafida.fatimatuzzahra")
<li><a href="{{action('Controller@getdaftarizin')}}"><span class="pink-text text-darken-4">Daftar Ijin Kegiatan</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endif
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
            @if($usernameSSO === "fadlurrahman.ar")
                <th data-field="nama_kegiatan">Nama Kegiatan</th>
                <th data-field="penyelenggara">Penyelenggara</th>
                <th data-field="deskripsi">Deskripsi</th>
                <th data-field="status">Status</th>
                <th class="center-align" data-field="action">Action</th>
            @elseif($usernameSSO === "rafida.fatimatuzzahra")
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
        @if($usernameSSO === "kevin.mahendra")
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
        @elseif ($usernameSSO === "rafida.fatimatuzzahra")
            @foreach($daftarizinsekre as $daftarizinn)
            <tr>
                <td>{{$daftarizinn->nama}}</td>
                <td>{{$daftarizinn->nama_kegiatan}}</td>
                <td>{{$daftarizinn->penyelenggara}}</td>
                <td>{{$daftarizinn->deskripsi}}</td>
                <td>{{$daftarizinn->status}}</td>
                <td>
                    <!-- <a class="modal-trigger" href="#modal1"><i class="material-icons pink-text text-darken-4 right">mode_edit</i></a> -->
                    <div class="center-align">
                        <i class="material-icons pink-text text-darken-4">swap_vert</i>
                    </div>
                </td>
                <!-- Modal Structure -->
                      <!-- <div id="modal1" class="modal">
                        <div class="modal-content">
                          {!! Form::open([]) !!}
                            <p>
                              <input name="group1" type="radio" id="test1" value="Belum Diproses" />
                              <label for="test1">Belum Diproses</label>
                            </p>
                            <p>
                              <input name="group1" type="radio" id="test2" value="Diproses"  />
                              <label for="test2">Diproses</label>
                            </p>
                            <p>
                              <input name="group1" type="radio" id="test3" value="Selesai" />
                              <label for="test2">Selesai</label>
                            </p>
                            <div class="row">
                                <a class="waves-effect waves-light btn pink darken-4">SUBMIT</a>
                                <a class="modal-action modal-close btn grey darken-1">Close</a>
                            </div>
                        {!! Form::close() !!}
                        </div>
                      </div> -->
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
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
    $('.modal-trigger').leanModal();
</script>
@endsection














