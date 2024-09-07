<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
    ];
        // Disable timestamps if not needed
        public $timestamps = false;

        public function wishlistfromuser(){
            return $this->belongsTo(User::class,'user_id');
        }
        public function wishlistfromproduct(){
            return $this->belongsTo(Product::class, 'product_id');
        }
}
