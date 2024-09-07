<?php

namespace App\Http\Controllers;

use DB;
use App\Models\order;
use App\Models\about_u;
use App\Models\comment;
use App\Models\Product;
use App\Models\order_item;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\home_page_Banner;
use App\Http\Controllers\Controller;
use App\Models\website_properties_card;



class IndexController extends Controller
{
    public function index(){
        $Banner= home_page_Banner::get();  
        $prodcat= ProductCategory::get(); 
        $vegetables=ProductCategory::where('category_name','Vegetables')->with('productcat')->get();
        $Cards= website_properties_card::get(); 
        $Testimonials= comment::with('commentuser')->get(); 

$topProducts = \DB::table('orders')
    ->select('product_id', \DB::raw('count(*) as total_orders'))
    ->groupBy('product_id')
    ->orderBy('total_orders', 'desc')
    ->take(3)
    ->get();

$productIds = $topProducts->pluck('product_id')->implode(',');

// Get the product details in the correct order
$topProductsWithDetails = Product::whereIn('id', $topProducts->pluck('product_id'))
    ->withCount(['orders'])
    ->orderByRaw("FIELD(id, $productIds)")
    ->get();


        return view('user.index',compact(['prodcat','Banner','Cards','vegetables','Testimonials','topProductsWithDetails'])); 
    }

    public function Testimonials(){
        $Testimonials= comment::with('commentuser')->get(); 
        return view('user.testimonial',compact(['Testimonials'])); 
    }

    public function about_Us(){
        $about= about_u::get(); 
        return view('user.about_us',compact('about')); 
    }
    public function contact(){
        $about= about_u::get(); 
        return view('user.about_us',compact('about')); 
    }
}
