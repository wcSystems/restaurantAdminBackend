<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function sale_orders()
    {
        return $this->hasMany(SaleOrder::class);
    }
}
