@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getsurat')}}"><span class="pink-text text-darken-4">Buat Permohonan Surat</span></a></li>
<li><a href="{{action('Controller@getdaftarsurat')}}"><span class="pink-text text-darken-4">Daftar Surat</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">SOP</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Surat</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <form class="col s12">
            <div class="s12 m4 l8">
                <table class="striped" style="font-size:80%;">    
                    <thead>
                      <tr>
                          <th data-field="tipe" style="padding-right: 5em;">TipeSurat</th>
                          <th data-field="nama" style="padding-right: 5em;">NamaPemohon</th>
                          <th data-field="keperluan" style="padding-right: 5em;">Keperluan Surat</th>
                          <th data-field="status">Status</th>
                          
                      </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Surat Magang</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                            <td>Selesai</td>
                            <td><a class="btn-flat disabled"><i class="material-icons">mode_edit</i></a></td>
                        </tr>
                        <tr>
                            <td>Transkrip Nilai</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                            <td>Selesai</td>
                            <td><a class="btn-flat disabled"><i class="material-icons">mode_edit</i></a></td>
                        </tr>
                        <tr>
                            <td>Transkrip Nilai</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                            <td>Menunggu</td>
                            <td><a class="waves-effect waves-teal btn-flat"><i class="material-icons">mode_edit</i></a></td>
                        </tr>
                        <tr>
                            <td>Transkrip Nilai</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                            <td>Menunggu</td>
                            <td><a class="waves-effect waves-teal btn-flat"><i class="material-icons">mode_edit</i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </form>
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
</script>
@endsection














