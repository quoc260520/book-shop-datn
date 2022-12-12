<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['order_id', 'book_id', 'amount', 'price'];
    
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
