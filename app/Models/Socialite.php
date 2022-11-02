<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    const GOOGLE_SOCIALATION = 1;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_socialites',
        'user_socialite_id',
        'avatar'
    ];
}
