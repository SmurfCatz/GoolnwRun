<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'event_name',
        'event_category',
        'event_date',
        'event_location',
        'event_province',
        'registration_open_date',
        'registration_close_date',
        'event_status',
    ];

    public function subEvents()
    {
        return $this->hasMany(SubEvent::class, 'event_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
