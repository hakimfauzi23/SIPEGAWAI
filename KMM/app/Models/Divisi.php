<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Divisi extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'divisi';

    protected $fillable = [
        'nm_divisi'
    ];

    public $sortable = [
        'id',
        'nm_divisi'
    ];

    public function pegawai()
    {
        return $this->hasMany('App\Models\Pegawai');
    }

    public function riwayat_divisi()
    {
        return $this->hasMany('App\Models\Riwayat_divisi');
    }
}
