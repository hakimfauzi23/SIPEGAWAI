<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Pegawai extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'pegawai';

    protected $fillable = [
        'id',
        'id_role',
        'nik',
        'nama',
        'jk',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'alamat_ktp',
        'alamat_dom',
        'status',
        'jml_anak',
        'no_hp',
        'email',
        'password',
        'tgl_masuk',
        'id_jabatan',
        'id_divisi',
        'path'
    ];

    public $sortable = [
        'id',
        'id_role',
        'nik',
        'nama',
        'jk',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'alamat_ktp',
        'alamat_dom',
        'status',
        'jml_anak',
        'no_hp',
        'email',
        'tgl_masuk',
        'id_jabatan',
        'id_divisi',
    ];

    public function cuti()
    {
        return $this->hasMany('App\Models\Cuti');
    }

    public function presensi_harian()
    {
        return $this->hasMany('App\Models\Presensi_kehadiran');
    }

    public function rekap_kehadiran()
    {
        return $this->hasMany('App\Models\Rekap_kehadiran');
    }




    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'id_jabatan', 'id');
    }

    public function divisi()
    {
        return $this->belongsTo('App\Models\Divisi', 'id_divisi', 'id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'id_role', 'id');
    }


    public function riwayat_divisi()
    {
        return $this->belongsToMany('App\Models\Divisi');
    }

    public function riwayat_jabatan()
    {
        return $this->belongsToMany('App\Models\Jabatan');
    }

}
