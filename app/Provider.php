<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
