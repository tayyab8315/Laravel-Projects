<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $prod= Product::with(['Category','subCategory'])->get();

        $prod = Product::with(['Category', 'subCategory'])->Paginate(10);
        
        return (view('admin.manage_products',compact('prod')));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cat= ProductCategory::get();    
        return (view('admin.Add_product',compact('cat')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:100',
            'prod_price' => 'required|numeric|min:1|max:100',
            'prod_discount' => 'numeric|min:1|max:100',
            'image' => 'required|mimes:png,jpg,jpeg|max:30000',
            'main_cat' => 'required|exists:product_categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'Prod_Desc' => 'required|string|max:300|min:40',
        ]);


    $image =$request->file('image');
    $filename = time().'.'.$image->getClientOriginalExtension();
   $path = $request->file('image')->storeAs('Images/Product',$filename,'public');
//    return $request;
   Product::create([
    'name'=> $request->product_name,
    'price'=> $request->prod_price,
    'discount'=> $request->prod_discount,
    'image'=> $path,
    'description'=> $request->Prod_Desc,
    'category_id'=> $request->main_cat,
    'Subcategory_id'=> $request->subcategory,
    'sale'=>'no',
    'feature'=>'no'
            ]);
            return redirect()->route('Product.index')->with('status','Product is Added Successfully');



}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodCat = Product::with(['Category','subCategory'])->find($id);
        
        $cat= ProductCategory::get();
        return (view('admin.update_product',compact('prodCat','cat')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodCat = Product::with(['Category','subCategory'])->find($id);
        
        return (view('admin.product_detail',compact('prodCat')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'product_name' => 'required|string|max:100',
            'prod_price' => 'required|numeric|min:1|max:100',
            'prod_discount' => 'numeric|min:1|max:100',
            'image' => 'mimes:png,jpg,jpeg|max:30000',
            'main_cat' => 'required|exists:product_categories,id',
            'subcategory' => 'required|exists:sub_categories,id',
            'Prod_Desc' => 'required|string|max:300|min:40',
        ]);
        $find =Product::find($id);
        $path =$find->image;
        if($request->hasFile('image')){

            $img_path = public_path("storage/".$find->image);
            if(file_exists($img_path)){
                @unlink($img_path);
            }
        $image =$request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
       $path = $request->file('image')->storeAs('Images/Product',$filename,'public');
        }
       

$find->update([
    'name'=> $request->product_name,
    'price'=> $request->prod_price,
    'discount'=> $request->prod_discount,
    'image'=> $path,
    'description'=> $request->Prod_Desc,
    'category_id'=> $request->main_cat,
    'Subcategory_id'=> $request->subcategory
            ]);
            return redirect()->route('Product.index')->with('status','Product is Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodCat = Product::find($id);
      
        $img_path = public_path("storage/".$prodCat->image);
        if(file_exists($img_path)){
            @unlink($img_path);
        }
        $prodCat->delete();
        return redirect()->route('Product.index')->with('deleted', 'Product Is Deleted Successfully');
    
}
    

    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('cat_id', $category_id)->get();
        return response()->json($subcategories);
    }



public function showcat(Request $request)
{
    $category = $request->data[0];
    $page = $request->data[1];
$perpage = 4;
$from = ($page-1)*$perpage;
    try {
        if ($category == 'all') {
            $products = Product::with(['Category', 'subCategory'])
            ->skip($from)
            ->take($perpage)
            ->get();
            $totalProducts = Product::count();
        } else {
            $products = Product::where('category_id', $category)
            ->with(['Category', 'subCategory'])
            ->skip($from) 
            ->take($perpage) 
            ->get();
            $totalProducts = Product::where('category_id', $category) ->count();

        }

        $totalPages = ceil($totalProducts / $perpage);
    
        return response()->json([
            'success' => true,
            'data' => $products,
            'query'=> $category,
            'current_page'=>$page,
            'totalt_pages'=> $totalPages,
            'operation'=>'tabs',
            'task'=>'tabs',


        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error fetching products.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function feature(string $id)
{
    $prodCat = Product::with(['Category','subCategory'])->find($id);
    $feature=$prodCat->feature;
if($feature=='no'){
    $feature='yes';
}else if($feature=='yes'){
    $feature='no';
}

    $prodCat->update([
        'feature'=> $feature,
                ]);
       
    return redirect()->route('Product.index');
}

public function sale(string $id)
{
    $product = Product::with(['Category','subCategory'])->find($id);
    $sale= $product->sale;
    if($sale =='no'){
        $sale='yes';
    }else if($sale =='yes'){
        $sale ='no';
    }
    
        $product->update([
            'sale'=> $sale,
                    ]);
    return redirect()->route('Product.index');
}


}
