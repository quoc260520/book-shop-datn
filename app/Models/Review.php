<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'star', 'content'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
