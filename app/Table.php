<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }

    public function sale_orders()
    {
        return $this->belongsToMany(SaleOrder::class)->withTimestamps();
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
