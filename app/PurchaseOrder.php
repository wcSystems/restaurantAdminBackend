<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function purchase_order_details()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
