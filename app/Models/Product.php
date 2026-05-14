<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['merchant_id', 'category_id', 'name', 'description', 'price', 'photo', 'stock'])]
class Product extends Model
{
    use HasFactory;

    /**
     * Get the merchant (user) that owns the product
     */
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    /**
     * Get the category of the product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
