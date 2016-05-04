<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keluhans extends Model
{
    protected $fillable = ['username','prioritas', 'divisi', 'status', 'keluhan', 'email', 'no_hp', 'judul'];
}
