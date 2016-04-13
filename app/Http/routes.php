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
Route::get('/home', 'Controller@portaltohome');
Route::get('/logout', 'Controller@logout');

#halaman berisi form create pengajuan [localhost:8000/ijin]
Route::get('/pengajuanijin', 'Controller@getCreateIzin'); 
Route::post('action/pengajuanijin/create', 'Controller@createizin'); 
#{return view('action/pengajuanijin/ijin'); });

#Menampilkan daftar  izin
Route::get('/pengajuanijin/daftar-izin', 'Controller@getdaftarizin');

#Menampilkan halaman surat
Route::get('/surat', 'Controller@getsurat');

Route::get('/surat/daftar-surat', 'Controller@getdaftarsurat');

Route::get('/daftar-user', 'Controller@getdaftaruser');

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
