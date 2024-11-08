<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $fillable = ['sale_date', 'total_amount', 'total_cost', 'total_profit', 'payment_method', 'notes'];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity', 'purchase_price', 'sale_price')
                    ->withTimestamps();
    }
}
