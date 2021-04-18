<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    use HasFactory;

    protected $table = 'akses';

    protected $fillable = [
        'id_role',
        'id_menu',
        'is_aktif',
    ];
}
