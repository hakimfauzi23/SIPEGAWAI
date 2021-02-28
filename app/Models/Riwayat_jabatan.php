<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Riwayat_jabatan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_jabatan';

    protected $fillable = [
        'id_pegawai',
        'id_jabatan',
        'thn_mulai',
        'thn_selesai'
    ];

}
