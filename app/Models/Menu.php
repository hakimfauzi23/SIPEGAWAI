<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'urutan_menu',
        'nm_menu',
        'class_menu',
        'url_menu',
        'icon',
        'id_group',
    ];

    public function group_menu()
    {
        return $this->belongsTo('App\Models\Group_menu', 'id_jabatan', 'id');
    }

    public function role()
    {
        return $this->belongsToMany('App\Models\Role');
    }

}
