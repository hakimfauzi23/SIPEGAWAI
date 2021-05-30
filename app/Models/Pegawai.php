<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

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
        'id_atasan',
        'id_jabatan',
        'id_divisi',
        'path'
    ];

    protected $dates = ['deleted_at'];

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

    public function riwayat_jabatan()
    {
        return $this->hasMany('App\Models\Riwayat_jabatan');
    }

    public function riwayat_divisi()
    {
        return $this->hasMany('App\Models\Riwayat_Divisi');
    }

    public function atasan()
    {
        return $this->hasMany('App\Models\Pegawai');
    }

    public function gaji()
    {
        return $this->hasMany('App\Models\Gaji');
    }

    public function surat_peringatan()
    {
        return $this->hasMany('App\Models\SuratPeringatan');
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

    public function bawahan()
    {
        return $this->belongsTo('App\Models\Pegawai', 'id_atasan', 'id');
    }



    public function potongan()
    {
        return $this->belongsToMany(Potongan::class, 'pegawai_potongan');
    }

    public function tunjangan()
    {
        return $this->belongsToMany(Tunjangan::class, 'pegawai_tunjangan');
    }
}
