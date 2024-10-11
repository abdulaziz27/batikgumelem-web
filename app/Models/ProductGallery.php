<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['url', 'is_featured', 'product_id'];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function getUrlAttribute()
    // {
    //     return $this->attributes['url'] ? Storage::url($this->attributes['url']) : null;
    // }

}
