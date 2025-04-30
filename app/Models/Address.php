<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
    'address_house_number',
    'address_village',
    'address_alley',
    'address_road',
    'address_subdistrict',
    'address_district',
    'address_province',
    'address_postal_code'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);  // เชื่อมโยงกับ Model Member
    }
}

