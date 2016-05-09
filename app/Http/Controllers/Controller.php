<?php

namespace App\Http\Controllers;
require '../vendor/autoload.php';
use SSO\SSO;
use App\users;
use App\kegiatans;
use App\mahasiswas;
use App\staffs;
use App\pelayanan_akademiks;
use App\info_kemahasiswaans;
use App\keluhans;
use DB;
use Log;
use Alert;
use Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

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
                $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
                return view('action.home', ['username' => $usernameSSO, 'role' => $roledatabase, 'email' => $email, 'no_hp' => $no_hp]);
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
        $daftarizinsekre = DB::table('kegiatans')->join('users', 'users.username', '=', 'kegiatans.username')->where('status', '=', 'Disetujui')->orWhere('status', '=', 'Diproses')->get();
        $daftarizinmanajer = DB::table('kegiatans')->join('users', 'users.username', '=', 'kegiatans.username')->where('status', '=', 'Belum Diproses')->get();
        $i = 0;
        $j = -1;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        return view('action.pengajuanijin.daftarizin', compact('daftarizin', 'daftarizinsekre', 'daftarizinmanajer', 'roledatabase', 'i', 'j'));
    }
    public function getdaftarizinselesai()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftarizinsekre = DB::table('kegiatans')->join('users', 'users.username', '=', 'kegiatans.username')->where('status', '=', 'Selesai')->get();
        $j = -1;
        return view('action.pengajuanijin.daftarizinselesai', compact('daftarizinsekre', 'j'));
    }
    
     public function getdaftarizinlist()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftarizinmanajer = DB::table('kegiatans')->join('users', 'users.username', '=', 'kegiatans.username')->where('status', '=', 'Disetujui')->orWhere('status', '=', 'Tidak Disetujui')->get();
        $j = -1;
        return view('action.pengajuanijin.listdaftarizin', compact('daftarizinmanajer', 'j'));
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
    public function updatestatusizin($id, Request $request){
        $input = $request->all();
        $status = $input['status'];
        DB::table('kegiatans')->where('id', $id)->update(['status' => $status]);
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
        $suratsekretariat = DB::table('pelayanan_akademiks')->join('users', 'users.username', '=', 'pelayanan_akademiks.username' )->join('mahasiswas', 'mahasiswas.username', '=', 'pelayanan_akademiks.username' )->where('status', '=', 'Diproses')->orWhere('status', '=', 'Belum Diproses')->get();

        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $i = 0;
        $j = -1;
        return view('action.surat.lihatSurat', compact('surat', 'suratsekretariat', 'roledatabase', 'i', 'j'));
    }
    public function getdaftarsuratselesai()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $suratsekretariat = DB::table('pelayanan_akademiks')->join('users', 'users.username', '=', 'pelayanan_akademiks.username' )->join('mahasiswas', 'mahasiswas.username', '=', 'pelayanan_akademiks.username' )->where('status', '=', 'Selesai')->get();
        $j = -1;
        return view('action.surat.lihatSuratSelesai', compact('surat', 'suratsekretariat', 'usernameSSO', 'j'));
    }
    public function editsurat($id)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $surat = pelayanan_akademiks::findOrFail($id);
        $pemiliksurat = DB::table('pelayanan_akademiks')->where('id', '=', $id)->value('username');
        $statusurat = DB::table('pelayanan_akademiks')->where('id', '=', $id)->value('status');
        if($pemiliksurat == $usernameSSO && $statusurat == "Belum Diproses"){
            return view('action.surat.editsurat', compact('surat'));
        }
        else {return view('errors/404');}

        
    }
    public function updatesurat($id, Request $request)
    {
        $surat = pelayanan_akademiks::findOrFail($id);
        $surat->update($request->all());
        return redirect('surat/daftar-surat');
    }
    public function updatestatussurat($id, Request $request)
    {
        $input = $request->all();
        $status = $input['status'];
        DB::table('pelayanan_akademiks')->where('id', $id)->update(['status' => $status]);
        return redirect('surat/daftar-surat');
    }
    public function hapussurat($id)
    {
        DB::table('pelayanan_akademiks') -> where('id','=', $id) -> delete();
        return redirect ('surat/daftar-surat');
    }


#----------------------------INFO KEMAHASISWAAN---------------------------------------

    public function showcreateinfo() 
    {
        // Alert::message('Robots are working!');
        return view ('action/infokemahasiswaan/createinfo');
    }
    public function showinfokemahasiswaan() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $info = DB::table('info_kemahasiswaans')->where('status', '=', 'Published')->orderBy('created_at', 'desc')->paginate(9);
        if($roledatabase == "sekretariat"){
            return view ('action/infokemahasiswaan/infokemahasiswaan', compact('info', 'roledatabase'));
        }
        else {return view('errors/404');}
    }
    public function showinfo_kemahasiswaan() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $info = DB::table('info_kemahasiswaans')->where('status', '=', 'Published')->orderBy('created_at', 'desc')->paginate(9);
        if($roledatabase == "sekretariat"){
            return view('errors/404');
        }
        else {
            return view ('action/infokemahasiswaan/infokemahasiswaan_view', compact('info', 'roledatabase'));
        }
    }
    public function showinfo_kemahasiswaan_detail($id) 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $info = info_kemahasiswaans::findOrFail($id);
        $gambar = $info['gambar'];
        $judul = $info['judul'];
        $isi_info = $info['isi_info'];
        $created_at = $info['created_at'];
        // if($roledatabase == "sekretariat"){
        //     return view ('action/infokemahasiswaan/infodetail_sekre', compact('judul', 'isi_info', 'created_at', 'gambar', 'roledatabase'));
        // }
        // else {
            return view ('action/infokemahasiswaan/infodetail_view', compact('judul', 'isi_info', 'created_at', 'gambar', 'roledatabase'));
        // }
    }
    public function store(Request $request)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        // dd(Input::get('publish'));
        if(Input::get('publish') == "publish"){
            $id = info_kemahasiswaans::create(['username' => $usernameSSO, 'judul' => $request['judul'], 'isi_info' => $request['isi_info'], 'status' => "Published"])->id;

        }
        else{
            $id = info_kemahasiswaans::create(['username' => $usernameSSO, 'judul' => $request['judul'], 'isi_info' => $request['isi_info'], 'status' => "Draft"])->id;
        }

        $mime = Image::make(Input::file('image'))->mime();
        $extension = substr($mime, 6);
        Image::make(Input::file('image'))->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save(base_path() . '/public/images/info_kemahasiswaan/' . $id . '.' . $extension);
        $imageName = $id . '.' . $extension;
        DB::table('info_kemahasiswaans')->where('id', $id)->update(['gambar' => $imageName]);
        return redirect('info');
    }
    public function editinfo($id)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $pembuatinfo = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $info = info_kemahasiswaans::findOrFail($id);
        if($pembuatinfo == "sekretariat"){
            return view('action.infokemahasiswaan.editinfo', compact('info'));
        }
        else{
            return view('errors/404');
        }
        
    }
    public function updateinfo($id, Request $request)
    {
        $info = info_kemahasiswaans::findOrFail($id);
        $info->update($request->all());
        $gambar = DB::table('info_kemahasiswaans')->where('id', '=', $id)->value('gambar');
        // dd(Input::get('publish'));
        if(Input::hasFile('image')){
            $mime = Image::make(Input::file('image'))->mime();
            $extension = substr($mime, 6);
            Image::make(Input::file('image'))->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save(base_path() . '/public/images/info_kemahasiswaan/' . $id . '.' . $extension);
            $imageName = $id . '.' . $extension;
            if(Input::get('publish') == "publish"){
                DB::table('info_kemahasiswaans')->where('id', $id)->update(['gambar' => $imageName, 'status' => "Published"]);
                return redirect('info/info-published');
            }
            else{
                DB::table('info_kemahasiswaans')->where('id', $id)->update(['gambar' => $imageName, 'status' => "Draft"]);
                return redirect('info/info-draft');
            }
        }
        // dd(Input::get('publish'));
        else{
            if(Input::get('publish') == "publish"){
                DB::table('info_kemahasiswaans')->where('id', $id)->update(['status' => "Published"]);
                return redirect('info/info-published');
            }
            else{
                DB::table('info_kemahasiswaans')->where('id', $id)->update(['status' => "Draft"]);
                return redirect('info/info-draft');
            }
        }
    }
    public function getdaftarinfo() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;

        // INFO PUBLISHED
        $info = DB::table('info_kemahasiswaans')->where('status', '=', 'Published')->get();
        $statusinfo = "Published";
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $i = 0;
        $j = -1;
        return view('action.infokemahasiswaan.daftarinfotabel', compact('info', 'statusinfo', 'roledatabase', 'i', 'j'));
    }
    public function getdaftarinfodraft() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;

        // INFO DRAFT
        $info = DB::table('info_kemahasiswaans')->where('status', '=', 'Draft')->get();
        $statusinfo = "Draft";
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $i = 0;
        $j = -1;
        return view('action.infokemahasiswaan.daftarinfotabel', compact('info', 'statusinfo', 'roledatabase', 'i', 'j'));
    }
    public function hapusinfo($id)
    {
        DB::table('info_kemahasiswaans') -> where('id','=', $id) -> delete();
        return redirect ('info/info-draft');
    }

#--------------------------KELUHAN-----------------------------------------------------    

    
    public function createkeluhan(Request $keluhan)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $input = $keluhan->all();
        $prioritas=$input['prioritas'];
        $divisi=$input['divisi'];
        $email=$input['email'];
        $telepon=$input['no_hp'];
        $keluhan=$input['keluhan'];
        $judul=$input['judul'];
        $no_hp = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('no_hp');
        $email_mhs = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('email');
        $keluhan = keluhans::create(['prioritas' => $prioritas, 'divisi' => $divisi, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses", 'keluhan' => $keluhan, 'judul' => $judul])->id;
        return redirect ('keluhan');
    }
    
    public function getcreatekeluhan() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $no_hp = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('no_hp');
        $email_mhs = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('email');
        return view ('action/keluhan/createkeluhan', compact('email_mhs', 'no_hp'));
    }
    public function getdaftarkeluhan() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');

        // KELUHAN MAHASISWA
        $keluhanmahasiswa = DB::table('keluhans')->where('username', '=', $usernameSSO)->get();

        // KELUHAN TERTUJU
        $keluhantertuju = DB::table('keluhans')->join('users', 'users.username', '=', 'keluhans.username' )->join('mahasiswas', 'mahasiswas.username', '=', 'keluhans.username' )->where('divisi', '=', $roledatabase)->where('status', '=', 'belum diproses')->get();
        
        // KELUHAN DIPROSES
        $keluhandiproses = DB::table('keluhans')->join('users', 'users.username', '=', 'keluhans.username' )->join('mahasiswas', 'mahasiswas.username', '=', 'keluhans.username' )->where('divisi', '=', $roledatabase)->where('status', '=', 'diproses')->get();
        
        $i = 0;
        $j = -1;
        $k = -1000;
        return view('action.keluhan.daftarKeluhan', compact('keluhanmahasiswa', 'keluhantertuju', 'roledatabase', 'i', 'j', 'k'));
    }
    
    public function getdaftarkeluhandiproses()
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        
         // KELUHAN DIPROSES
        $keluhandiproses = DB::table('keluhans')->join('users', 'users.username', '=', 'keluhans.username' )->join('mahasiswas', 'mahasiswas.username', '=', 'keluhans.username' )->where('divisi', '=', $roledatabase)->where('status', '=', 'diproses')->get();
        
        return view('action.keluhan.daftarkeluhandiproses', compact('keluhandiproses', 'usernameSSO'));
    }
    
    public function updatestatuskeluhan($id, Request $request){
        $input = $request->all();
        $status = $input['status'];
        DB::table('keluhans')->where('id', $id)->update(['status' => $status]);
        return redirect('keluhan/daftar-keluhan');
    }
    
    public function hapuskeluhan($id)
    {
        DB::table('keluhans') -> where('id','=', $id) -> delete();
        return redirect ('keluhan/daftar-keluhan');
    }

#----------------------------MANIPULASI USER------------------------------------------

    
    public function getuser() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $daftaruser = DB::table('users')->get();
        $i = 0;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        if ($roledatabase == "admin"){
            return view('action/manipulasiuser/user', compact('daftaruser', 'i'));
        }
        else{return view('errors/404');}
        
    }
    public function updaterole($username, Request $request)
    {
        $input = $request->all();
        $role = $input['role'];
        DB::table('users')->where('username', $username)->update(['role' => $role]);
        return redirect('daftar-user');
    }



}