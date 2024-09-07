<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;
    // The table associated with the model
    protected $table = 'product_categories';

    // The attributes that are mass assignable
    protected $fillable = ['category_name', 'category_desc','category_image'];

    // Disable timestamps if not needed
    public $timestamps = false;

    public function subcat(){
        return $this->hasMany(SubCategory::class ,'cat_id','id');
    }
    public function productcat(){
        return $this->hasMany(Product::class,'category_id');
    }
}
