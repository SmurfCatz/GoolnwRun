<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Organizer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'organizers';

    protected $fillable = [
        'organizer_name',
        'organizer_email',
        'organizer_password',
        'organizer_tel',
        'organizer_details',
        'organizer_idcard',
        'organizer_experience',
        'organizer_image',
    ];

    protected $hidden = [
        'organizer_password',
        'remember_token',
    ];

    protected $casts = [
        'organizer_email_verified_at' => 'datetime',
        'organizer_password' => 'hashed',
    ];

    public function getAuthPassword()
{
    return $this->organizer_password;
}
}
