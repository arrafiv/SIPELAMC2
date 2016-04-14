<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelayanan_akademiks extends Model
{
     protected $fillable = ['tipe_surat', 'email', 'no_hp', 'keperluan'];
}
