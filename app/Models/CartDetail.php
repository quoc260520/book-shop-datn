<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'book_id',
        'amount',
    ];

   public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }

}
