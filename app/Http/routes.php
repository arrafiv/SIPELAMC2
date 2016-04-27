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

#--------------LOGINLOGOUT & TO PORTAL

Route::get('/home', 'Controller@loginredirect');
Route::get('/logout', 'Controller@logout');
Route::get('/home2', 'Controller@portaltohome');
Route::get('/admin', 'Controller@portaltohomeadmin');

#------------------UPDATE PROFILE

Route::post('/action/home', 'Controller@updatemahasiswa');


#------------------PENGAJUAN IJIN

#CREATE IZIN
Route::get('/pengajuanijin', 'Controller@getcreateizin'); 
Route::post('action/pengajuanijin/create', 'Controller@createizin');

#READ IZIN
Route::get('/pengajuanijin/daftar-izin', 'Controller@getdaftarizin');
Route::get('/pengajuanijin/daftar-izin-selesai', 'Controller@getdaftarizinselesai');
Route::get('/pengajuanijin/list-daftar-izin', 'Controller@getdaftarizinlist');

#UPDATE IZIN
Route::get('/pengajuanijin/{id}/edit', 'Controller@editizin');
Route::post('/pengajuanijin/{id}/edit', 'Controller@updateizin');
Route::post('/pengajuanijin/{id}/editstatus', 'Controller@updatestatusizin');

#DELETE IZIN
Route::get('/pengajuanijin/daftar-izin/{id}','Controller@hapusizin');


#-----------------------SURAT

#CREATE SURAT
Route::get('/surat', 'Controller@getsurat');
Route::post('/action/surat/createsurat', 'Controller@createsurat');

#READ SURAT
Route::get('/surat/daftar-surat', 'Controller@getdaftarsurat');
Route::get('/surat/daftar-surat-selesai', 'Controller@getdaftarsuratselesai');

#UPDATE SURAT
Route::get('/surat/{id}/edit', 'Controller@editsurat');
Route::post('/surat/{id}/edit', 'Controller@updatesurat');
Route::post('/surat/{id}/editstatus', 'Controller@updatestatussurat');

#DELETE SURAT
Route::get('/surat/daftar-surat/{id}','Controller@hapussurat');


#-----------------------USER (OLEH ADMIN)

#READ USER
Route::get('/daftar-user', 'Controller@getuser');

Route::post('/daftar-user/{username}', 'Controller@updaterole');




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
