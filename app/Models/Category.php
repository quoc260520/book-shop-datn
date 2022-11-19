<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categorys';
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'category_name',
        'parent_id',
    ];

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    public function categorys()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
}
