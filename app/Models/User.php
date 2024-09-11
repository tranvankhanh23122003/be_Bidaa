<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'userName',
        'fullName',
        'phoneNumber',
        'role',
        'avatar',
        'status',
        'point',
        'password',
    ];
}
