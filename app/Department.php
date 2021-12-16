<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function getActiveNameAttribute()
    {
        return ($this->is_active == 1 ? "เปิดทำการ" : "ปิดทำการ"); 
    }
}
