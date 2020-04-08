<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMenu extends Model
{
    public function rest_menus()
    {
        return $this->hasMany(RestMenu::class);
    }

    public function sub_categories()
    {
        return $this->hasMany(CategoryMenu::class);
    }

    public function parent_category()
    {
        return $this->belongsTo(CategoryMenu::class);
    }
}
