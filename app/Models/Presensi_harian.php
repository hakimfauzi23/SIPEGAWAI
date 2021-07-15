<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Presensi_harian extends Model
{
    use HasFactory;
    use Sortable;


    protected $table = 'presensi_harian';

    protected $fillable = [
        'id_pegawai',
        'tanggal',
        'jam_dtg',
        'jam_plg',
        'ket',
        'is_wfh',
    ];

    protected $sortable = [
        'id',
        'id_pegawai',
        'tanggal',
        'jam_dtg',
        'jam_plg',
        'ket',
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai', 'id');
    }
}
