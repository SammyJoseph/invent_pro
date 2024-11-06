<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'purchase_price', 'sale_price', 'stock', 'barcode'];

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
