<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    use HasFactory;

    protected $table = 'peraturan';

    protected $fillable = [
        'jam_masuk',
        'jam_plg',
        'jml_cuti_tahunan',
        'jml_cuti_besar',
        'jml_cuti_bersama',
        'jml_cuti_hamil',
        'jml_cuti_sakit',
        'jml_cuti_penting',
        'syarat_bulan_cuti_tahunan',
        'syarat_bulan_cuti_besar',
    ];
}
