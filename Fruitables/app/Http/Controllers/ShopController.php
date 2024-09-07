<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\website_properties_card;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category = ProductCategory::get();
        $categoryCounts = [];

        // Loop through each category and get the count of products
        foreach ($Category as $category) {
            $categoryCounts[$category->id] = Product::where('category_id', $category->id)->count();
        }
        $products = Product::with(['Category', 'subCategory'])->paginate(6);
//    return $products ;
        $featuredProducts = Product::where('feature', 'yes')
        ->with('prodcomment')
        ->take(5)
        ->get();
    //    return $featuredProducts ;

    $Cards= website_properties_card::get(); 
        return view('user.shop', compact('products','Category','categoryCounts','featuredProducts','Cards'))->withPath('shop');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $Category = ProductCategory::get();
        $categoryCounts = [];

        // Loop through each category and get the count of products
        foreach ($Category as $category) {
            $categoryCounts[$category->id] = Product::where('category_id', $category->id)->count();
        }
        $products = Product::with(['Category', 'subCategory'])->where('category_id',$id)->paginate(10);
        $featuredProducts = Product::where('feature', 'yes')
        ->with('prodcomment')
        ->take(5)
        ->get();
    //    return $featuredProducts ;

    $Cards= website_properties_card::get(); 
        return view('user.shop', compact('products','Category','categoryCounts','featuredProducts','Cards'))->withPath('shop');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Category = ProductCategory::get();
        $categoryCounts = [];

        // Loop through each category and get the count of products
        foreach ($Category as $category) {
            $categoryCounts[$category->id] = Product::where('category_id', $category->id)->count();
        }
        $product = Product::with(['Category', 'subCategory','prodcomment'])->find($id);

 $related_products =  Product::with(['Category',])
 ->where('id', '!=', $product->id) 
 ->where('category_id', $product->category_id)->get();
    
        $featuredProducts = Product::where('feature', 'yes')
        ->with('prodcomment')
        ->take(5)
        ->get();
        $Cards= website_properties_card::get(); 
        return view('user.single_shop_detail', compact('product','Category','categoryCounts','featuredProducts','Cards','related_products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function range(Request $request){
       $range = $request->data[0];
       $currentpage = $request->data[1];
       $perpage = 6;
       $from = ($currentpage-1)*$perpage;
        try {
            $products = Product::whereBetween('price', [0, $range])
            ->with(['category', 'subCategory'])
            ->skip($from)
            ->take($perpage)
            ->get();
            $totalProducts = Product::whereBetween('price', [0, $range])
            ->with(['category', 'subCategory'])
            ->skip($from)
            ->take($perpage)
            ->count();
            $totalPages = ceil($totalProducts / $perpage);
            return response()->json([
       'success' => true,
                'data' => $products,
                'query'=> $range,
                'current_page'=>  $currentpage,
                'totalt_pages'=> $totalPages,
                'operation'=>'range',  
                'task'=>'range',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching products.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function search(Request $request){
        $search = $request->data[0];
        $currentpage = $request->data[1];
        $perpage = 6;
        $from = ($currentpage-1)*$perpage;
         try {
            $products = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->with(['category', 'subCategory'])
            ->skip($from)
            ->take($perpage)
            ->get();
            $totalProducts = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->with(['category', 'subCategory'])
            ->count();
            $totalPages = ceil($totalProducts / $perpage);

           
             return response()->json([
                'success' => true,
                'data' => $products,
                'query'=> $search,
                'current_page'=>  $currentpage,
                'totalt_pages'=> $totalPages,
                'operation'=>'range',
                'task'=>'search',
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => 'Error fetching products.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }
     public function topbarsearch(Request $request){
        $search = $request->data[0];
        $currentpage = $request->data[1];
        $perpage = 6;
        $from = ($currentpage-1)*$perpage;
         try {
            $products = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->with(['category', 'subCategory'])
            ->skip($from)
            ->take($perpage)
            ->get();
            $totalProducts = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->with(['category', 'subCategory'])
            ->count();
            $totalPages = ceil($totalProducts / $perpage);

           
             return response()->json([
                'success' => true,
                'data' => $products,
                'query'=> $search,
                'current_page'=>  $currentpage,
                'totalt_pages'=> $totalPages,
                'operation'=>'topbarsearch',
                'task'=>'topbarsearch',
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => 'Error fetching products.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }

     public function additional(Request $request){
 
        try {
              
        $comingvalue = $request->data[0];
        $currentpage = $request->data[1]; 
        $perpage = 6;
        $from = ($currentpage-1)*$perpage;

       if($comingvalue=='Organic'){
        $products = Product::with(['category', 'subCategory'])
        ->whereHas('subCategory', function ($query) {
            $query->where('sub_category_name', 'Organic');
        })
        ->skip($from)
        ->take($perpage)
        ->get();
        $totalProducts = Product::with(['category', 'subCategory'])
        ->whereHas('subCategory', function ($query) {
            $query->where('sub_category_name', 'Organic');
        })->count();
    
       }else if($comingvalue=='Fresh'){
        $products = Product::with(['category', 'subCategory'])
        ->orderBy('id', 'desc')
        ->skip($from)
        ->take($perpage)
        ->get();
        $totalProducts = Product::count();
       }else if($comingvalue=='Sales'){
        $products = Product::where('sale', 'yes')
        ->with(['category', 'subCategory'])
        ->skip($from)
        ->take($perpage)
        ->get();
        $totalProducts = Product::where('sale', 'yes')->count();
       }else if($comingvalue=='Discount'){
        $products = Product::where('discount', '>',0)
        ->with(['category', 'subCategory'])
        ->skip($from)
        ->take($perpage)
        ->get();
        $totalProducts = Product::where('discount', '>',0)->count();
    }else if($comingvalue=='Feature'){
        $products = Product::where('feature', 'yes')
        ->with(['category', 'subCategory'])
        ->skip($from)
        ->take($perpage)
        ->get();
        $totalProducts = Product::where('feature', 'yes')->count();
       }
       $totalPages = ceil($totalProducts / $perpage);
            
             return response()->json([
                
                 'success' => true,
                 'data' => $products,
                 'query'=> $comingvalue,
                 'current_page'=>  $currentpage,
                 'totalt_pages'=> $totalPages,
                 'operation'=>'range',
                 'task'=>'additional',
             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => 'Error fetching products.',
                 'error' => $e->getMessage()
             ], 500);
         }

     }
}
