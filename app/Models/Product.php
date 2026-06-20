<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'code', 'product_category_id', 'name', 'slug', 'description', 'material',
        'dimensions', 'weight', 'finishing', 'price', 'hpp', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'price' => 'decimal:2', 'hpp' => 'decimal:2'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }
}
