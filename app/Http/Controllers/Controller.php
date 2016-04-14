<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';
use SSO\SSO;
use App\users;
use App\kegiatans;
use App\mahasiswas;
use App\staffs;
use App\pelayanan_akademiks;
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


#----------------------------LOGINLOGOUT TO PORTAL-------------------------------------

    public function loginredirect()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $nameSSO  = $user->name;
        $roleSSO  = $user->role;
        
        $result = DB::table('users')->where('username', '=', $usernameSSO)->count();
        
        if ($bol == true){
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
    public function logout()
    {
        SSO::logout();
        return view('login');
    }
    public function portaltohome()
    {
        return redirect('home');
    }


#----------------------------UPDATE PROFILE-------------------------------------


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



#----------------------------PENGAJUAN IZIN-------------------------------------


    public function createizin(Request $kegiatans)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $input = $kegiatans->all();
        $nama_kegiatan=$input['nama'];
        $penyelenggara=$input['penyelenggara'];
        $tanggal_mulai_kegiatan = date_create($input['tanggal_mulai_kegiatan']); 
        $tanggal_selesai_kegiatan = date_create($input['tanggal_selesai_kegiatan']);
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
        $daftarizinsekre = DB::table('kegiatans')->join('users', 'users.username', '=', 'kegiatans.username')->get();
        return view('action.pengajuanijin.daftarizin', compact('daftarizin', 'daftarizinsekre', 'usernameSSO'));
    }
    public function editizin($id)
    {
        $izin = kegiatans::findOrFail($id);
        return view('action.pengajuanijin.editizin', compact('izin'));
    }
    public function updateizin($id, Request $request)
    {
        $izin = kegiatans::findOrFail($id);
        $input = $request->all();
        $nama_kegiatan=$input['nama_kegiatan'];
        $penyelenggara=$input['penyelenggara'];
        $tanggal_mulai_kegiatan = date_create($input['tanggal_mulai_kegiatan']); 
        $tanggal_selesai_kegiatan = date_create($input['tanggal_selesai_kegiatan']);
        $deskripsi=$input['deskripsi'];
        $email=$input['email'];
        $telepon=$input['no_hp'];
        DB::table('kegiatans')->where('id', $id)->update(['nama_kegiatan' => $nama_kegiatan, 'penyelenggara' => $penyelenggara, 'tanggal_mulai_kegiatan' => $tanggal_mulai_kegiatan, 'tanggal_selesai_kegiatan' => $tanggal_selesai_kegiatan, 'deskripsi' => $deskripsi, 'email' => $email, 'no_hp' => $telepon]);
        return redirect('pengajuanijin/daftar-izin');
    }
    public function hapusizin($id)
    {
        DB::table('kegiatans') -> where('id','=', $id) -> delete();
        return redirect ('pengajuanijin/daftar-izin');
    }


#----------------------------SURAT------------------------------------------


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

        // SURAT MAHASISWA
        $surat = DB::table('pelayanan_akademiks')->where('username', '=', $usernameSSO)->get();

        // SURAT SEKRETARIAT
        $suratsekretariat = DB::table('pelayanan_akademiks')->join('users', 'users.username', '=', 'pelayanan_akademiks.username' )->get();
        // $usernamesurat = $suratsekretariat->username;
        // $namapanjang = DB::table('users')->where('username', '=', $usernamesurat)->value('nama');

        return view('action.surat.lihatSurat', compact('surat', 'suratsekretariat', 'usernameSSO'));
    }
    public function editsurat($id)
    {
        $surat = pelayanan_akademiks::findOrFail($id);
        return view('action.surat.editsurat', compact('surat'));
    }
    public function updatesurat($id, Request $request)
    {
        $surat = pelayanan_akademiks::findOrFail($id);
        $surat->update($request->all());
        return redirect('surat/daftar-surat');
    }
    public function hapussurat($id)
    {
        DB::table('pelayanan_akademiks') -> where('id','=', $id) -> delete();
        return redirect ('surat/daftar-surat');
    }




#----------------------------MANIPULASI USER------------------------------------------

    
    public function getuser() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftaruser = DB::table('users')->get();
        $i = 0;
        return view('action/manipulasiuser/user', compact('daftaruser', 'i'));
    }
    public function updaterole($username, Request $request)
    {
        $input = $request->all();
        $role = $input['role'];
        DB::table('users')->where('username', $username)->update(['role' => $role]);
        return redirect('daftar-user');
    }



}