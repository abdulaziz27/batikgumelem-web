<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'slug',
        'description',
        'category_id',
        'stock',
    ];

    protected $appends = ['average_rating'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    /**
     * Get the sizes for the product.
     */
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating for the product.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->where('is_approved', true)->avg('rating') ?? 0;
    }

    /**
     * Get the total stock across all sizes.
     */
    public function getTotalSizeStockAttribute()
    {
        return $this->sizes()->sum('stock');
    }

    /**
     * Check if a user has reviewed this product.
     */
    public function hasBeenReviewedBy($userId)
    {
        return $this->reviews()->where('user_id', $userId)->exists();
    }
}
