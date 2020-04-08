<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleOrderDetail extends Model
{
    public function sale_order()
    {
        return $this->belongsTo(SaleOrder::class);
    }

    public function rest_menu()
    {
        return $this->belongsTo(RestMenu::class);
    }
}
