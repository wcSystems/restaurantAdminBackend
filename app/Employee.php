<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function tables()
    {
        return $this->belongsToMany(Table::class)->withTimestamps();
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function supervised_employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function supervisor_employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
