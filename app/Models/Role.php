<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';

    protected $fillable = [
        'nm_role',
        'url'
    ];


    public function pegawai()
    {
        return $this->hasMany('App\Models\Pegawai');
    }


    public function menu()
    {
        return $this->belongsToMany('App\Models\Menu');
    }
}
