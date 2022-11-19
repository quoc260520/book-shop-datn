<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'publisher_name',
        'email',
        'phone',
        'address',
        'more_info',
    ];

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
