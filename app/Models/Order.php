<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_SHIP = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'voucher_id', 'address', 'phone', 'email', 'status', 'total_money'];
    
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
