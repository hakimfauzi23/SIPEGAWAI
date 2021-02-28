<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi_harian extends Model
{
    use HasFactory;

    protected $table = 'presensi_harian';

    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'jam_dtg',
        'jam_plg',
        'enum',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','id_pegawai','id');
    }
}
