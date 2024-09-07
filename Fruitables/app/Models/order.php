<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'product_quantity',
        'first_name',
        'last_name',
        'company_name',
        'address',
        'city',
        'country',
        'postcode',
        'mobile',
        'email',
        'ship_to_different_address',
        'payment_method',
        'order_number',
        'order_confirmed_at',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_number', 'order_number');
    }
    public function Order_items()
    {
        return $this->hasMany(order_item::class, 'order_number', 'order_number');
    }
}
