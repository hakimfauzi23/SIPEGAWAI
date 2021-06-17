<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'no_telp',
        'email_public',
        'path_logo',
        'email_private',
        'password',
    ];
}
