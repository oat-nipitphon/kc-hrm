<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_position extends Model
{
    public function warehouse_position()
    {
        return $this->belongsTo('App\Warehouse_position');
    }
}
