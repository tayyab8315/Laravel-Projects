<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['name','review','rating','status','product_id','user_id'];
    public function commentprod(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function commentuser(){
        return $this->belongsTo(User::class,'user_id');
    }
    
}
