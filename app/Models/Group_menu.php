<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_menu extends Model
{
    use HasFactory;

    protected $table = 'group_menu';


    protected $fillable = [
        'nm_group'
    ];


    public function menu()
    {
        return $this->hasMany('App\Models\Menu');
    }
}
