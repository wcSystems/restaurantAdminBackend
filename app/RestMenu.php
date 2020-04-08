<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestMenu extends Model
{
    public function category_menu()
    {
        return $this->belongsTo(CategoryMenu::class);
    }

    public function meal_time()
    {
        return $this->belongsTo(MealTime::class);
    }

    public function order_restriction()
    {
        return $this->belongsTo(OrderRestriction::class);
    }

    public function sale_order_details()
    {
        return $this->hasMany(SaleOrderDetail::class);
    }
}
