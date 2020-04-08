<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category_product()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function measure_unit()
    {
        return $this->belongsTo(MeasureUnit::class);
    }

    public function purchase_order_details()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
}
