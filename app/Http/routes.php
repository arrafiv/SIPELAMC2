<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login', 'Controller@loginsso');
Route::get('/home', 'Controller@loginredirect');
Route::get('/home2', 'Controller@portaltohome');
Route::get('/admin', 'Controller@portaltohomeadmin');
Route::get('/logout', 'Controller@logout');

#halaman berisi form create pengajuan [localhost:8000/pengajuanijin]
Route::get('/pengajuanijin', 'Controller@getcreateizin'); 
Route::post('action/pengajuanijin/create', 'Controller@createizin'); 
#{return view('action/pengajuanijin/ijin'); });

#Menampilkan daftar izin
Route::get('/pengajuanijin/daftar-izin', 'Controller@getdaftarizin');
Route::get('/pengajuanijin/daftar-izin-admin', 'Controller@getdaftarizinadmin');

#form create new surat
Route::get('/surat', 'Controller@getsurat');
Route::post('/action/surat/createsurat', 'Controller@createsurat');

#Menampilkan daftar surat
Route::get('/surat/daftar-surat', 'Controller@getdaftarsurat');

#Menampilkan daftar user
Route::get('/daftar-user', 'Controller@getuser');

#Ubah data user : mahasiswa
Route::post('/action/home', 'Controller@updatemahasiswa');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
