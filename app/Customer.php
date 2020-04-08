<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function sale_orders()
    {
        return $this->hasMany(SaleOrder::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
