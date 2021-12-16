<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    protected $table = 'calendar_events';
    public $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = [
        'name',
        'options',
        'type',
        'calendar_id',
        'created_by'
    ];
}
