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
use Illuminate\Support\Facades\Mail;
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
                $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
                if($roledatabase == "mahasiswa"){
                    $email = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('email');
                    $no_hp = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('no_hp');
                }
                else{
                    $email = DB::table('staffs')->where('username', '=', $usernameSSO)->value('email');
                    $no_hp = DB::table('staffs')->where('username', '=', $usernameSSO)->value('no_hp');
                }
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


    public function updatemahasiswa(Request $request)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $input = $request->all();
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $email=$input['email'];
        $telepon=$input['no_hp'];
        if ($roledatabase == "mahasiswa") {
            DB::table('mahasiswas')->where('username', $user->username)->update(['email' => $email, 'no_hp' => $telepon]);
            return redirect('home');
        }
        else{
            DB::table('staffs')->where('username', $user->username)->update(['email' => $email, 'no_hp' => $telepon]);
            return redirect('home');
        }
        
    }



#----------------------------PENGAJUAN IZIN-------------------------------------


    public function createizin(Request $request)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $input = $request->all();
        $nama_kegiatan=$input['nama'];
        $penyelenggara=$input['penyelenggara'];
        $tanggal_mulai_kegiatan = date_create($input['tanggal_mulai_kegiatan']); 
        $tanggal_selesai_kegiatan = date_create($input['tanggal_selesai_kegiatan']);
        $deskripsi=$input['deskripsi'];
        $email=$input['email'];
        $telepon=$input['no_hp'];
        $file=$input['file'];
        kegiatans::create(['nama_kegiatan' => $nama_kegiatan, 'penyelenggara' => $penyelenggara, 'tanggal_mulai_kegiatan' => $tanggal_mulai_kegiatan, 'tanggal_selesai_kegiatan' => $tanggal_selesai_kegiatan, 'deskripsi' => $deskripsi, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses", 'file' => $file]);
        // if ($email != "") {
        //     Mail::send('emails.e_izinmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "no"], function($message) use ($email, $usernameSSO)
        //     {
        //         $message->to($email, $usernameSSO)->subject("Pengajuan Izin");   
        //     });
        // }
        // $manajerakademik = DB::table('staffs')->join('users', 'staffs.username', '=', 'users.username' )->where('role', '=', "manajer akademik")->get();
        // foreach ($manajerakademik as $manajer) {
        //     if ($manajer->email != "") {
        //         Mail::send('emails.e_izinmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "yes"], function($message) use ($manajer, $usernameSSO)
        //         {
        //             $message->to($manajer->email, $usernameSSO)->subject("Pengajuan Izin");   
        //         });
        //     }
        // }
        return redirect ('pengajuanijin');
    }
    
    public function getcreateizin() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $no_hp = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('no_hp');
        $email_mhs = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('email');
        return view ('action/pengajuanijin/create', compact('email_mhs', 'no_hp'));
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
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $izin = kegiatans::findOrFail($id);
        $input = $request->all();
        $nama_kegiatan=$input['nama_kegiatan'];
        $penyelenggara=$input['penyelenggara'];
        $tanggal_mulai_kegiatan = date_create($input['tanggal_mulai_kegiatan']); 
        $tanggal_selesai_kegiatan = date_create($input['tanggal_selesai_kegiatan']);
        $deskripsi=$input['deskripsi'];
        $email=$input['email'];
        $telepon=$input['no_hp'];
        $file=$input['file'];
        DB::table('kegiatans')->where('id', $id)->update(['nama_kegiatan' => $nama_kegiatan, 'penyelenggara' => $penyelenggara, 'tanggal_mulai_kegiatan' => $tanggal_mulai_kegiatan, 'tanggal_selesai_kegiatan' => $tanggal_selesai_kegiatan, 'deskripsi' => $deskripsi, 'email' => $email, 'no_hp' => $telepon, 'file' => $file]);
        // if ($email != "") {
        //     Mail::send('emails.e_izinmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "no"], function($message) use ($email, $usernameSSO)
        //     {
        //         $message->to($email, $usernameSSO)->subject("Pengajuan Izin");   
        //     });
        // }
        // $manajerakademik = DB::table('staffs')->join('users', 'staffs.username', '=', 'users.username' )->where('role', '=', "manajer akademik")->get();
        // foreach ($manajerakademik as $manajer) {
        //     if ($manajer->email != "") {
        //         Mail::send('emails.e_izinmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "yes"], function($message) use ($manajer, $usernameSSO)
        //         {
        //             $message->to($manajer->email, $usernameSSO)->subject("Pengajuan Izin");   
        //         });
        //     }
        // }
        return redirect('pengajuanijin/daftar-izin');
    }

    public function updatestatusizin($id, Request $request){
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $izin = kegiatans::findOrFail($id);
        $input = $request->all();
        $status = $input['status'];
        DB::table('kegiatans')->where('id', $id)->update(['status' => $status]);
        // if ($izin->email != "") {
        //     if ($roledatabase == "sekretariat") {
        //         Mail::send('emails.e_izinmhs', ['status' => $status, 'tostaffpenting' => "no"], function($message) use ($izin)
        //         {
        //             $message->to($izin->email, $izin->username)->subject("Pengajuan Izin");   
        //         });
        //     }
        //     else{
        //         $pesan = $input['pesan'];
        //         Mail::send('emails.e_izinmhs', ['status' => $status, 'pesan' => $pesan, 'tostaffpenting' => "no"], function($message) use ($izin)
        //         {
        //             $message->to($izin->email, $izin->username)->subject("Pengajuan Izin");   
        //         });
        //     }
        // }
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
        pelayanan_akademiks::create(['tipe_surat' => $tipe_surat, 'keperluan' => $keperluan, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses"]);

        // $sekretariat = DB::table('staffs')->join('users', 'staffs.username', '=', 'users.username' )->where('role', '=', "sekretariat")->get();
        // if ($email != "") {
        //      Mail::send('emails.e_suratmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "no"], function($message) use ($email, $usernameSSO)
        //     {
        //         $message->to($email, $usernameSSO)->subject("Permohonan Surat");   
        //     });
        // }
        // foreach ($sekretariat as $sekre) {
        //     if ($sekre->email != "") {
        //         Mail::send('emails.e_suratmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "yes"], function($message) use ($sekre, $usernameSSO)
        //         {
        //             $message->to($sekre->email, $usernameSSO)->subject("Permohonan Surat");   
        //         });
        //     }
        // }
        return redirect ('surat');
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
    
    public function getsurat() 
    {   
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $no_hp = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('no_hp');
        $email_mhs = DB::table('mahasiswas')->where('username', '=', $usernameSSO)->value('email');
        return view ('action/surat/createsurat', compact('email_mhs', 'no_hp'));
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

    public function updatesurat($id, Request $request)
    {
        $surat = pelayanan_akademiks::findOrFail($id);
        $surat->update($request->all());
        // $sekretariat = DB::table('staffs')->join('users', 'staffs.username', '=', 'users.username' )->where('role', '=', "sekretariat")->get();
        // if ($surat->email != "") {
        //     Mail::send('emails.e_suratmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "no"], function($message) use ($surat)
        //     {
        //         $message->to($surat->email, $surat->username)->subject("Permohonan Surat");   
        //     });
        // }
        // foreach ($sekretariat as $sekre) {
        //     if ($sekre->email != "") {
        //         Mail::send('emails.e_suratmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "yes"], function($message) use ($sekre)
        //         {
        //             $message->to($sekre->email, $sekre->username)->subject("Permohonan Surat");   
        //         });
        //     }
        // }
        return redirect('surat/daftar-surat');
    }
    public function updatestatussurat($id, Request $request)
    {
        $surat = pelayanan_akademiks::findOrFail($id);
        $input = $request->all();
        $status = $input['status'];
        DB::table('pelayanan_akademiks')->where('id', $id)->update(['status' => $status]);
        // if ($surat->email != "") {
        //     Mail::send('emails.e_suratmhs', ['status' => $status, 'tostaffpenting' => "no"], function($message) use ($surat)
        //     {
        //         $message->to($surat->email, $surat->username)->subject("Permohonan Surat");   
        //     });
        // }
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
        return view ('action/infokemahasiswaan/infodetail_view', compact('judul', 'isi_info', 'created_at', 'gambar', 'roledatabase'));
    }
    public function store(Request $request)
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
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
        $gambar = DB::table('info_kemahasiswaans')->where('id', '=', $id)->value('gambar');
        $info = info_kemahasiswaans::findOrFail($id);
        if($pembuatinfo == "sekretariat"){
            return view('action.infokemahasiswaan.editinfo', compact('info', 'gambar'));
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
        // $manajerterkait = DB::table('staffs')->join('users', 'staffs.username', '=', 'users.username' )->where('role', '=', $divisi)->get();
        $keluhanid = keluhans::create(['prioritas' => $prioritas, 'divisi' => $divisi, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses", 'keluhan' => $keluhan, 'judul' => $judul])->id;
        // if ($email != "") {
        //     Mail::send('emails.e_keluhanmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "no"], function($message) use ($email, $usernameSSO)
        //     {
        //         $message->to($email, $usernameSSO)->subject("Keluhan dan Saran");   
        //     });
        // }
        // foreach ($manajerterkait as $manajer) {
        //     if ($manajer->email != "") {
        //         Mail::send('emails.e_keluhanmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "yes"], function($message) use ($manajer, $usernameSSO)
        //         {
        //             $message->to($manajer->email, $usernameSSO)->subject("Keluhan dan Saran");   
        //         });
        //     }
        // }
        if(Input::hasFile('image')){
            $mime = Image::make(Input::file('image'))->mime();
            $extension = substr($mime, 6);
            Image::make(Input::file('image'))->resize(350, null, function ($constraint) {$constraint->aspectRatio();})->save(base_path() . '/public/images/keluhan/' . $keluhanid . '.' . $extension);
            $imageName = $keluhanid . '.' . $extension;
            DB::table('keluhans')->where('id', $keluhanid)->update(['gambar' => $imageName]);
            return redirect ('keluhan');
        }
        else{
            return redirect ('keluhan');
        }
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
        
        $j = -1;
        
         // KELUHAN DIPROSES
        $keluhandiproses = DB::table('keluhans')->join('users', 'users.username', '=', 'keluhans.username' )->join('mahasiswas', 'mahasiswas.username', '=', 'keluhans.username' )->where('divisi', '=', $roledatabase)->where('status', '=', 'Diterima')->get();
        
        return view('action.keluhan.daftarkeluhandiproses', compact('keluhandiproses', 'j'));
    }
    
    public function updatestatuskeluhan($id, Request $request){
        $keluhan = keluhans::findOrFail($id);  
        $input = $request->all();
        $status = $input['status'];
        $pesan = $input['pesan'];
        DB::table('keluhans')->where('id', $id)->update(['status' => $status]);
        // if ($keluhan->email != "") {
        //     Mail::send('emails.e_keluhanmhs', ['status' => $status, 'pesan' => $pesan, 'tostaffpenting' => "no"], function($message) use ($keluhan)
        //     {
        //         $message->to($keluhan->email, $keluhan->username)->subject("Keluhan dan Saran");   
        //     });
        // }
        return redirect('keluhan/daftar-keluhan');
    }
    
    public function editkeluhan($id)        
    {       
        $keluhan = keluhans::findOrFail($id);
        $gambar = DB::table('keluhans')->where('id', '=', $id)->value('gambar');       
        return view('action.keluhan.editkeluhan', compact('keluhan', 'gambar'));      
    }       
            
    public function updatekeluhan($id, Request $request)        
    {       
        $bol = SSO::authenticate();     
        $user = SSO::getUser();     
        $usernameSSO  = $user->username;        
        $keluhan = keluhans::findOrFail($id);       
        $input = $request->all();       
        $prioritas=$input['prioritas'];     
        $divisi=$input['divisi'];       
        $telepon=$input['no_hp'];       
        $keluhan=$input['keluhan'];     
        $judul=$input['judul'];     
        $email=$input['email'];     
        $telepon=$input['no_hp'];       
        DB::table('keluhans')->where('id', $id)->update(['prioritas' => $prioritas, 'divisi' => $divisi, 'email' => $email, 'no_hp' => $telepon, 'username' => $usernameSSO, 'status' => "Belum Diproses", 'keluhan' => $keluhan, 'judul' => $judul]);
        
        // $manajerterkait = DB::table('staffs')->join('users', 'staffs.username', '=', 'users.username' )->where('role', '=', $divisi)->get();
        // if ($email != "") {
        //     Mail::send('emails.e_keluhanmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "no"], function($message) use ($email, $usernameSSO)
        //     {
        //         $message->to($email, $usernameSSO)->subject("Keluhan dan Saran");   
        //     });
        // }
        // foreach ($manajerterkait as $manajer) {
        //     if ($manajer->email != "") {
        //         Mail::send('emails.e_keluhanmhs', ['status' => "Belum Diproses", 'tostaffpenting' => "yes"], function($message) use ($manajer, $usernameSSO)
        //         {
        //             $message->to($manajer->email, $usernameSSO)->subject("Keluhan dan Saran");   
        //         });
        //     }
        // }
        if(Input::hasFile('image')){
            $mime = Image::make(Input::file('image'))->mime();
            $extension = substr($mime, 6);
            Image::make(Input::file('image'))->resize(350, null, function ($constraint) {$constraint->aspectRatio();})->save(base_path() . '/public/images/keluhan/' . $keluhanid . '.' . $extension);
            $imageName = $keluhanid . '.' . $extension;
            DB::table('keluhans')->where('id', $keluhanid)->update(['gambar' => $imageName]);
            return redirect ('keluhan');
        }
        else{
            return redirect ('keluhan');
        } 
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

#----------------------------ANALYTICS AND REPORT---------------------------------------

    public function showreportsurat() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $thisMonth = date('m');
        $thisMonthString = date('M');

        #SURAT-SURAT
        $suratCountAll = DB::table('pelayanan_akademiks')->count();
        $suratCountThisMonth = DB::table('pelayanan_akademiks')->whereMonth('created_at', '=', $thisMonth)->count();
        $suratCountBelumDiproses = DB::table('pelayanan_akademiks')->where('status', '=', "Belum Diproses")->count();
        $suratCountPerBulan = DB::table('pelayanan_akademiks')->select( DB::raw('count(*) as jumlah, MONTHNAME(created_at) as bulan'))->groupBy(DB::raw('MONTH(created_at)'))->get();
        return view ('action/analytics/reportsurat', compact('roledatabase', 'suratCountAll', 'suratCountThisMonth', 'thisMonthString', 'suratCountBelumDiproses', 'suratCountPerBulan'));
    }
    public function showreportizin() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $thisMonth = date('m');
        $thisMonthString = date('M');

        #PENGAJUAN IJIN
        $izinCountAll = DB::table('kegiatans')->count();
        $izinThisMonth = DB::table('kegiatans')->whereMonth('created_at', '=', $thisMonth)->count();
        $izinBelumDiproses = DB::table('kegiatans')->where('status', '=', "Belum Diproses")->count();
        $izinTidakDisetujui = DB::table('kegiatans')->where('status', '=', "Tidak Disetujui")->count();
        $izinDisetujui = DB::table('kegiatans')->where('status', '=', "Disetujui")->count();
        $izinDiproses = DB::table('kegiatans')->where('status', '=', "Diproses")->count();
        $izinSelesai = DB::table('kegiatans')->where('status', '=', "Selesai")->count();
        $izinCountPerBulan = DB::table('kegiatans')->select( DB::raw('count(*) as jumlah, MONTHNAME(created_at) as bulan'))->groupBy(DB::raw('MONTH(created_at)'))->get();
        return view ('action/analytics/reportizin', compact('roledatabase', 'thisMonthString', 'izinCountAll', 'izinThisMonth', 'izinBelumDiproses', 'izinTidakDisetujui', 'izinDisetujui', 'izinDiproses', 'izinSelesai', 'izinCountPerBulan'));
    }
    public function showreportkeluhan() 
    {
        $bol = SSO::authenticate();
        $user = SSO::getUser();
        $usernameSSO  = $user->username;
        $roledatabase = DB::table('users')->where('username', '=', $usernameSSO)->value('role');
        $thisMonth = date('m');
        $thisMonthString = date('M');

        #PENGAJUAN IJIN
        $keluhanCountAll = DB::table('keluhans')->where('divisi', '=', $roledatabase)->count();
        $keluhanCountThisMonth = DB::table('keluhans')->whereMonth('created_at', '=', $thisMonth)->where('divisi', '=', $roledatabase)->count();
        $keluhanCountBelumDiproses = DB::table('keluhans')->where('status', '=', "Belum Diproses")->where('divisi', '=', $roledatabase)->count();
        $keluhanDiproses = DB::table('keluhans')->where('status', '=', "Diproses")->where('divisi', '=', $roledatabase)->count();
        $keluhanCountPerBulan = DB::table('keluhans')->select( DB::raw('count(*) as jumlah, MONTHNAME(created_at) as bulan'))->groupBy(DB::raw('MONTH(created_at)'))->where('divisi', '=', $roledatabase)->get();
        return view ('action/analytics/reportkeluhan', compact('roledatabase', 'thisMonthString', 'keluhanCountAll', 'keluhanCountThisMonth', 'keluhanCountBelumDiproses', 'keluhanCountPerBulan'));
    }

}