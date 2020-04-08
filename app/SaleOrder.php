<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order_type()
    {
        return $this->belongsTo(OrderType::class);
    }

    public function status_order()
    {
        return $this->belongsTo(StatusOrder::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class)->withTimestamps();
    }

    public function sale_order_details()
    {
        return $this->hasMany(SaleOrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
