<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_divisi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_divisi';

    protected $fillable = [
        'id_pegawai',
        'id_divisi',
        'thn_mulai',
        'thn_selesai'
    ];
}
