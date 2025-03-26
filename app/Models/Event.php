<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'name',
        'event_date',
        'category',
        'location',
        'registration_start',
        'registration_end',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function competitionTypes()
    {
        return $this->hasMany(CompetitionType::class);
    }
}
