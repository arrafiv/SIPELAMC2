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

#-----------------------INFO KEMAHASISWAAN

#CREATE INFO
Route::get('/info', 'Controller@showcreateinfo');
Route::post('/action/infokemahasiswaan/createinfo', 'Controller@store');

#READ INFO
Route::get('/info/info-published', 'Controller@getdaftarinfo');
Route::get('/info/info-draft', 'Controller@getdaftarinfodraft');
Route::get('/info/info-kemahasiswaan', 'Controller@showinfokemahasiswaan');
Route::get('/info_kemahasiswaan', 'Controller@showinfo_kemahasiswaan');
Route::get('/info_kemahasiswaan/{id}', 'Controller@showinfo_kemahasiswaan_detail');
// Route::get('/surat/daftar-surat-selesai', 'Controller@getdaftarsuratselesai');

#UPDATE INFO
Route::get('/info/{id}/edit', 'Controller@editinfo');
Route::post('/info/{id}/edit', 'Controller@updateinfo');
// Route::post('/surat/{id}/editstatus', 'Controller@updatestatussurat');

#DELETE INFO (HANYA DRAFT)
Route::get('/info/info-draft/{id}','Controller@hapusinfo');

#-----------------------KELUHAN

#CREATE KELUHAN
Route::get('/keluhan', 'Controller@getcreatekeluhan');
Route::post('/action/keluhan/createkeluhan', 'Controller@createkeluhan');

#READ KELUHAN
Route::get('/keluhan/daftar-keluhan', 'Controller@getdaftarkeluhan');
Route::get('/keluhan/daftar-keluhan-diproses', 'Controller@getdaftarkeluhandiproses');

#DELETE KELUHAN
Route::get('/keluhan/daftar-keluhan/{id}','Controller@hapuskeluhan');

#UPDATE KELUHAN
Route::get('/keluhan/{id}/edit', 'Controller@editkeluhan');
Route::post('/keluhan/{id}/edit', 'Controller@updatekeluhan');
Route::post('/keluhan/{id}/editstatus', 'Controller@updatestatuskeluhan');

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
