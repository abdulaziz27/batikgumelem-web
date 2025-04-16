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

    // Special flag to disable the accessor during form processing
    protected static $disableAccessor = false;

    public static function disableAccessor()
    {
        static::$disableAccessor = true;
    }

    public static function enableAccessor()
    {
        static::$disableAccessor = false;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute($value)
    {
        // Return raw value during form processing
        if (static::$disableAccessor) {
            return $value;
        }

        if (empty($value)) {
            return null;
        }

        // For view display in Filament - just return the raw value
        if (request()->is('admin*') || request()->is('filament*')) {
            // For admin listing pages, return the raw value
            // This works for Tables\Columns\ImageColumn
            if (request()->routeIs('*index') || request()->routeIs('*view*')) {
                return asset('storage/' . $value);
            }

            // For edit form - format the value for FileUpload component
            if (request()->routeIs('*edit*') || request()->ajax()) {
                return $value;
            }
        }

        // For frontend display
        return asset('storage/' . $value);
    }

    // Add this to ensure we don't accidentally overwrite the URL with null
    public function setUrlAttribute($value)
    {
        // Only set if a value is provided
        if (!is_null($value)) {
            $this->attributes['url'] = $value;
        }
    }

    // Helper to get original URL value
    public function getRawUrl()
    {
        return $this->attributes['url'] ?? null;
    }
}
