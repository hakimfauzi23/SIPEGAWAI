<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPegawai extends Model
{
    use HasFactory;

    protected $table = 'penilaian_pegawai';

    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'responsible',
        'initiate',
        'teamwork',
        'discipline',
        'work_performance',
        'final_value',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai', 'id');
    }
}
