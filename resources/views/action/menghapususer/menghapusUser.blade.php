@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="#" class="active"><span class="pink-text text-darken-4">Daftar User</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">Daftar Staf</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="#"><span class="pink-text text-darken-4">Daftar User</span></a></li>
<li><a href="#"><span class="pink-text text-darken-4">Daftar Staf</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar Seluruh User</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <form class="col s12">
            <div class="s12 m4 l8">
                <table class="striped" style="font-size:80%;">    
                    <thead>
                      <tr>
                          <th data-field="username" style="padding-right: 5em;">Username</th>
                          <th data-field="nama" style="padding-right: 5em;">Nama</th>
                          <th data-field="id" style="padding-right: 5em;">NIP/NPM</th>
                          <th data-field="telepon">Telepon</th>
                          <th data-field="email">Email</th>
                          <th data-field="role">Role</th>
                      </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>rifqi.putra42</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">1406573974</td>
                            <td>081234567890</td>
                            <td>rifqi@gmail.com</td>
                            <td>Mahasiswa</td>
                            <td><a class="waves-effect waves-teal btn-flat"><i class="material-icons">delete</i></a></td>
                        </tr>
                        <tr>
                            <td>kaem.situmorang</td>
                            <td>Kevin Mahendra</td>
                            <td style="">1306573974</td>
                            <td>081234567890</td>
                            <td>kaem@gmail.com</td>
                            <td>Mahasiswa</td>
                            <td><a class="waves-effect waves-teal btn-flat"><i class="material-icons">delete</i></a></td>
                        </tr>
                        <tr>
                            <td>rifqi.putra42</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">1406573974</td>
                            <td>081234567890</td>
                            <td>rifqi@gmail.com</td>
                            <td>Mahasiswa</td>
                            <td><a class="waves-effect waves-teal btn-flat"><i class="material-icons">delete</i></a></td>
                        </tr>
                        <tr>
                            <td>rifqi.putra42</td>
                            <td>Rifqi P. Bahalwan</td>
                            <td style="">1406573974</td>
                            <td>081234567890</td>
                            <td>rifqi@gmail.com</td>
                            <td>Mahasiswa</td>
                            <td><a class="waves-effect waves-teal btn-flat"><i class="material-icons">delete</i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </form>
    </div>
    <ul class="pagination" style="p">
        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!">4</a></li>
        <li class="waves-effect"><a href="#!">5</a></li>
        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
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














