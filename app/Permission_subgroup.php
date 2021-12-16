<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Permission_subgroup extends Model
{
    public function permission()
    {
        return $this->hasMany('App\Permission','display_name','group_name');
    }
}
