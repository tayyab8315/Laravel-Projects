<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    // The attributes that are mass assignable
    protected $fillable = ['sub_category_name','sub_category_desc','cat_id'];

    // Disable timestamps if not needed
    public $timestamps = false;

    use HasFactory;
    public function Cat(){
        return $this->belongsTo(ProductCategory::class);
    }
    
    public function productsubcat(){
        return $this->hasMany(Product::class, 'Subcategory_id', 'id');
    }

}
