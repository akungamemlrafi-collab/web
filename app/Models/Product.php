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
        'category_id',
        'name_id',
        'name_en',
        'slug',
        'description_id',
        'description_en',
        'price_idr',
        'price_usd',
        'stock',
        'weight',
        'image',
        'images',
        'is_active',
        'is_featured',
        'sku',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the name in the current locale
     */
    public function getNameAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->name_en : $this->name_id;
    }

    /**
     * Get the description in the current locale
     */
    public function getDescriptionAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? $this->description_en : $this->description_id;
    }

    /**
     * Get the price in the current locale/currency
     */
    public function getPriceAttribute(): float
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? ($this->price_usd ?? 0) : $this->price_idr;
    }

    /**
     * Get the currency symbol
     */
    public function getCurrencyAttribute(): string
    {
        $locale = app()->getLocale();
        return $locale === 'en' ? 'USD' : 'IDR';
    }

    /**
     * Get category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get order items
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Scope to get only active products
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->active();
    }
}
