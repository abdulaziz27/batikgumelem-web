<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'stock'
    ];

    /**
     * Get the product that owns the size.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the cart items for the size.
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the transaction items for the size.
     */
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
