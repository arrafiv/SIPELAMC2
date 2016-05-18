<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kegiatans extends Model
{
    protected $fillable = ['tanggal_mulai_kegiatan', 'tanggal_selesai_kegiatan', 'email', 'no_hp', 'penyelenggara', 'nama_kegiatan', 'deskripsi', 'username', 'status', 'file'];
}
