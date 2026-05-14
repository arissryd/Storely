<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['merchant_id', 'name', 'description', 'slug'])]
class Category extends Model
{
    use HasFactory;

    /**
     * Get the merchant (user) that owns the category
     */
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    /**
     * Get the products in this category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
