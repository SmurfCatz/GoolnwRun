<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'package_price',
        'package_maxparticipants',
        'package_extra_fee_per_person',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
