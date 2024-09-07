<?php

namespace App\Models;

use App\Models\order;
use App\Models\comment;
use App\Models\wishlist;
use App\Models\SubCategory;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','image','description','category_id','Subcategory_id','feature','discount','sale','avg_rating'];

    // Disable timestamps if not needed
    public $timestamps = false;

    public function Category(){
        return $this->belongsTo(ProductCategory::class);
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class, 'Subcategory_id', 'id');
    }

    public function prodcomment(){
        return $this->hasMany(comment::class,'product_id');
    }
    
    public function orders(){
        return $this->hasMany(order::class,'product_id');
    }
    public function Orderinclusion(){
        return $this->hasMany(order_item::class,'product_id');
    }
    public function productintowishlist(){
        return $this->hasMany(wishlist::class, 'product_id');
    }
}
