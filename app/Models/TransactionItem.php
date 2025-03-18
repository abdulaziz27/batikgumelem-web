<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_size_id',
        'size_name',
        'quantity',
        'price'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product size that belongs to the transaction item.
     */
    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($transactionItem) {
            $product = Product::find($transactionItem->product_id);
            if ($product) {
                $transactionItem->price = $product->price;
            }
        });
    }
}
