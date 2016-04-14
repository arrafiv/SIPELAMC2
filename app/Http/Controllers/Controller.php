<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';
use SSO\SSO;
use App\users;
use App\kegiatans;
use App\mahasiswas;
use App\staffs;
use DB;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function loginredirect()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $nameSSO  = $user->name;
        $roleSSO  = $user->role;
        
        $result = DB::table('users')->where('username', '=', $usernameSSO)->count();
        
        if ($bol == true){
            if($usernameSSO == "fadlurrahman.ar"){ //admin
                return view('action.admin');
            }
            else{
                if($result == 0)
                    {
                        # MENAMBAHKAN USER BARU
                        $newUser = new users;
                        $newUser->username = $usernameSSO;
                        $newUser->nama = $nameSSO;
                        $newUser->role = $roleSSO;
                        $newUser->save();

                        # MENAMBAHKAN MAHASISWA
                        if($newUser->role == "mahasiswa")
                        {
                            $newMahasiswa = new mahasiswas;
                            $newMahasiswa->username = $newUser->username;
                            $newMahasiswa->npm = $user->npm;
                            $newMahasiswa->save();
                        }

                         # MENAMBAHKAN STAFF
                        else
                        {
                            $newStaff = new staffs;
                            $newStaff->username = $newUser->username;
                            $newStaff->nip = $user->nip;
                            $newStaff->save();
                        }
                    }
                $email = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('email');
                $no_hp = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('no_hp');
                return view('action.home', ['username' => $usernameSSO, 'role' => $roleSSO, 'email' => $email, 'no_hp' => $no_hp]);
            }
        }
    }
    public function logout()
    {
        SSO::logout();
        return view('login');
    }
    public function portaltohome()
    {
        return redirect('home');
    }
    public function portaltohomeadmin()
    {
        return view('action.admin');
    }
    public function updatemahasiswa(Request $updateanmahasiswa)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $input = $updateanmahasiswa->all();
        $email=$input['email'];
        $telepon=$input['no_hp'];
        DB::table('mahasiswas')->where('username', $user->username)->update(['email' => $email, 'no_hp' => $telepon]);
        return redirect('home');
    }
    public function createizin(Request $kegiatans)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $input = $kegiatans->all();
        $nama_kegiatan=$input['nama'];
        $penyelenggara=$input['penyelenggara'];
        $tanggal_mulai_kegiatan=$input['tanggal_mulai_kegiatan'];
        $tanggal_selesai_kegiatan=$input['tanggal_selesai_kegiatan'];
        $deskripsi=$input['deskripsi'];
        $email=$input['email'];
        $telepon=$input['no_hp'];
        DB::table('kegiatans')->insert(['nama_kegiatan' => $nama_kegiatan, 'penyelenggara' => $penyelenggara, 'tanggal_mulai_kegiatan' => $tanggal_mulai_kegiatan, 'tanggal_selesai_kegiatan' => $tanggal_selesai_kegiatan, 'deskripsi' => $deskripsi, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses"]); //terusin
        return view ('action/pengajuanijin/create');
    }
    public function getcreateizin() 
    {
        return view ('action/pengajuanijin/create');
    }
    public function getdaftarizin()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftarizin = DB::table('kegiatans')->where('username', '=', $usernameSSO)->get();
        return view('action.pengajuanijin.daftarizin', compact('daftarizin'));
    }
    public function createsurat(Request $surat)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $input = $surat->all();
        $tipe_surat=$input['tipe_surat'];
        $keperluan=$input['keperluan'];
        $email=$input['email'];
        $telepon=$input['no_hp'];
        DB::table('pelayanan_akademiks')->insert(['tipe_surat' => $tipe_surat, 'keperluan' => $keperluan, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses"]); //terusin
        return view ('action/surat/createsurat');
    }
    public function getsurat() 
    {
        return view ('action/surat/createsurat');
    }
    public function getdaftarsurat() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $surat = DB::table('pelayanan_akademiks')->where('username', '=', $usernameSSO)->get();
        return view('action.surat.lihatSurat', compact('surat'));
    }
    public function getdaftarizinadmin()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftarizinadmin = DB::table('kegiatans')->get();
        return view('action.pengajuanijin.daftarizinadmin', compact('daftarizinadmin'));
    }
    public function getuser() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftaruser = DB::table('users')->get();
        return view('action/user', compact('daftaruser'));
    }
    public function getdaftaruser() 
    {
        return view ('action/menghapususer/menghapusUser');
    }
}