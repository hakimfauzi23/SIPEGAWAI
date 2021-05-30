<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPeringatan extends Model
{
    use HasFactory;

    protected $table = 'surat_peringatan';

    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'tingkat',
        'pelanggaran',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai', 'id');
    }

    protected $casts = [
        'pelanggaran' => 'array',
    ];
}
