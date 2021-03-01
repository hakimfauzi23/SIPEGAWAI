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
        'tgl_mulai',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai', 'id');
    }

    public function divisi()
    {
        return $this->belongsTo('App\Models\Divisi', 'id_divisi', 'id');
    }
}
