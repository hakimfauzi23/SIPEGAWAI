<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Cuti extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'cuti';

    protected $fillable = [
        'id_pegawai',
        'tipe_cuti',
        'tgl_pengajuan',
        'tgl_mulai',
        'tgl_selesai',
        'ket',
        'status'
    ];

    public $sortable = [
        'id_pegawai',
        'tipe_cuti',
        'tgl_pengajuan',
        'tgl_mulai',
        'tgl_selesai',
        'ket',
        'status'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','id_pegawai','id');
    }
}
