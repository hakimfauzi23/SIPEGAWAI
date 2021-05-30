<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    use HasFactory;

    protected $table = 'potongan';

    protected $fillable = [
        'nama',
        'jumlah',
    ];


    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_potongan');
    }
}
