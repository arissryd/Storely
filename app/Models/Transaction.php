<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_number',
        'product_id',
        'qty',
        'merchant_code'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}