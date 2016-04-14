@extends('layouts.mastercontent')

@extends('elements.element')
@section('isi-side-nav')
<li><a href="{{action('Controller@getuser')}}"><span class="pink-text text-darken-4">User</span></a></li>
@endsection
@section('isi-sidebar-in-content')
<li><a href="{{action('Controller@getuser')}}"><span class="pink-text text-darken-4">User</span></a></li>
@endsection

@section('content')
<div class="main">
    <div class="row">
        <div class="col s12 l8">
            <h4 class="grey-text text-darken-1">Daftar User</h4>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
    <table class="highlight">
        <thead>
            <tr>
                <th data-field="username">Username</th>
                <th data-field="nama">Nama</th>
                <th data-field="role">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($daftaruser as $daftaruserr)
            <tr>
                <td>{{$daftaruserr->username}}</td>
                <td>{{$daftaruserr->nama}}</td>
                <td>
                    <a class='dropdown-button btn' href='#' data-activates='dropdown1'>{{$daftaruserr->role}}</a>
                    <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">
                        Staf Sekretariat
                        </a></li>
                    <li class="divider"></li>
                    <li><a href="#!">
                        Manajer Akademik
                        </a></li>
                    <li><a href="#!">
                        Manajer Infrastruktur
                        </a></li>
                    <li><a href="#!">
                        Manajer Sarana Prasarana
                        </a></li>
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

