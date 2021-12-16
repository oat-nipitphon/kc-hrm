<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_guest extends Model
{
    protected $table = 'employee_guests';
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'firstname',
        'lastname',
        'relative',
        'employee_id',
        'rule_type',
        'rule'
    ];
}
