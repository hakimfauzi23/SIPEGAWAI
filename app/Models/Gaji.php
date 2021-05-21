<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';

    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'gaji_pokok',
        'jml_tunjangan',
        'jml_potongan',
        'tot_gaji_diterima',
        'path',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai', 'id');
    }

}
