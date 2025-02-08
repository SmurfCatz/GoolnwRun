<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'member_name',
        'member_email',
        'member_password',
        'member_role',
        'member_tel',
        'member_gender',
        'member_dob',
        'member_image',
    ];

    protected $hidden = [
        'member_password',
        'remember_token',
    ];

    protected $casts = [
        'member_email_verified_at' => 'datetime',
        'member_password' => 'hashed',
    ];

    /**
     * ความสัมพันธ์แบบ One-to-One กับ Address
     */
    public function addresses()
{
    return $this->hasMany(Address::class);
}

}
