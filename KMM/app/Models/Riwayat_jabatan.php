<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Riwayat_jabatan extends Model
{
    use Sortable;
    use HasFactory;

    protected $table = 'riwayat_jabatan';

    protected $fillable = [
        'id_pegawai',
        'id_jabatan',
        'tgl_mulai',
    ];

    protected $sortable = [
        'id_pegawai',
        'id_jabatan',
        'tgl_mulai',

    ];


    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','id_pegawai','id');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan','id_jabatan','id');

    }
}
