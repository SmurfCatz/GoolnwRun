<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_date',
        'event_category',
        'registration_open_date',
        'registration_close_date',
        'event_status',
    ];

    public function subEvents()
    {
        return $this->hasMany(SubEvent::class, 'event_id');
    }
}
