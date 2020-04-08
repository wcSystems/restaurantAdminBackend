<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderRestriction extends Model
{
    public function rest_menus()
    {
        return $this->hasMany(RestMenu::class);
    }
}
