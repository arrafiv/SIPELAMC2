@extends('layouts.mastercontent')

@section('styles')
<style type="text/css">
    #buttonmodal{
        margin-top: 10em;
    }
</style>
@endsection

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
                <th class="center-align" data-field="role">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($daftaruser as $daftaruserr)
            <tr>
                <td>{{$daftaruserr->username}}</td>
                <td>{{$daftaruserr->nama}}</td>
                <td>{{$daftaruserr->role}}</td>
                <td>
                    <div class="center-align">
                        <a class="modal-trigger btn-flat" data-target="{{$i}}"><i class="material-icons pink-text text-darken-4">mode_edit</i></a>
                    </div>
                    <div id="{{$i++}}" class="modal">
                        <div class="modal-content">
                          {!! Form::model($daftaruserr, ['action' => ['Controller@updaterole', $daftaruserr->username]]) !!}
                            <div class="input-field col s12">
                            <select name="role" >
                              <option value="" disabled selected>Choose your option</option>
                              <option value="mahasiswa">Mahasiswa</option>
                              <option value="sekretariat">Sekretariat</option>
                              <option value="manajer akademik">Manajer Akademik</option>
                              <option value="admin">Admin</option>
                            </select>
                            <label>UBAH ROLE USER</label>
                          </div>
                          <button class="waves-effect waves-light btn pink darken-4" id="buttonmodal">SUBMIT</button>
                        {!! Form::close() !!}
                        </div>
                      </div>
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
    $('.modal-trigger').leanModal();
    $('select').material_select();
</script>
@endsection

