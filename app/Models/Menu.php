<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'menus';

    protected $fillable = array('id_parent', 'judul', 'url', 'icon', 'id_hak_akses', 'order');

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'id_parent', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'id_parent');
    }


    public function hak_akses()
    {
        return $this->belongsTo('App\Models\Permission', 'id_hak_akses', 'id');
    }
}
