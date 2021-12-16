<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class Permission_user extends Model
{
    // use SoftDeletes;
    protected $table = "permission_user";
    public $timestamps = false;
    protected $fillable = [
        'permission_id',
        'user_id',
        'user_type'
    ];
}
