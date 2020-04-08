<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function parent_menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function sub_menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
