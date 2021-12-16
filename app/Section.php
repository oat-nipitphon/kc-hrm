<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function division_name()
    {
        return $this->belongsTo('App\Division','division_id');
    }

    public function get_division()
    {
        return $this->belongsTo('App\Division','division_id');
    }
}
