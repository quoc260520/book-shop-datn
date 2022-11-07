<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    const SALE = 1;
    const UN_SALE = 0;
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'book_name',
        'category_id',
        'author_id',
        'publisher_id',
        'price',
        'is_sale',
        'amount',
        'image',
        'status',
        'describe',
        'year_publish',
    ];

    protected $casts = [
        'image' => 'array'
   ];

   public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }




}
