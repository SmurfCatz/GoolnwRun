<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'sub_event_name',
        'sub_event_distance',
        'registration_fee',
    ];


    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
