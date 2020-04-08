<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasureUnit extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
