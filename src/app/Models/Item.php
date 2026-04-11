<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Purchase;

class Item extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    protected $fillable = [
    'name',
    'brand',
    'description',
    'price',
    'condition',
    'user_id',
    'image',
    ];

    public function categories()
    {
    return $this->belongsToMany(Category::class);
    }
}
