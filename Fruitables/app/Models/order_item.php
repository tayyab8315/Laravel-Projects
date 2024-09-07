<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'product_id',
        'product_quantity',
    ];
    public function items_order()
    {
        return $this->belongsTo(Order::class, 'order_number', 'order_number');
    }
    public function include_products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
