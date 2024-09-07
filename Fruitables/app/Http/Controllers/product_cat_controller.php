<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class product_cat_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodcat= ProductCategory::get();      
        return (view('admin.manage_product_cat',compact('prodcat')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_product_cat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'catName' => 'required|string|unique:product_categories,category_name|max:30',
            'catImg' => 'required|mimes:png,jpg,jpeg|max:30000',
            'catDesc' => 'required|string|max:300|min:40',
        ]);
        $image =$request->file('catImg');
    $filename = time().'.'.$image->getClientOriginalExtension();
   $path = $request->file('catImg')->storeAs('Images/Product',$filename,'public');
//    return $request;
        ProductCategory::create([
            'category_name'=>  $request->catName,
            'category_desc'=>  $request->catDesc,
            'category_image'=>$path ,
        ]);
        return redirect()->route('Product-cat.index')->with('status', 'Category Is Added Successfully');
        // return (view('admin.manage_product_cat'))->with('status','Category Is Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $prodCat = ProductCategory::find($id);
        return (view('admin.update_Prod_cat',compact('prodCat')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
        'catName' => 'required|string|max:30',
        'catImg' => 'mimes:png,jpg,jpeg|max:30000',
        'catDesc' => 'required|string|max:300|min:40',
    ]);
    $prodCat = ProductCategory::find($id);

    if($request->hasFile('catImg')){
    $img_path = public_path("storage/".$prodCat->category_image);
    if(file_exists($img_path)){
        @unlink($img_path);
    }
$image =$request->file('catImg');
$filename = time().'.'.$image->getClientOriginalExtension();
$path = $request->file('catImg')->storeAs('Images/Product',$filename,'public');
}else{
    $path = $prodCat->category_image;
}
    $prodCat->update([
        'category_name'=>  $request->catName,
        'category_desc'=>  $request->catDesc,
        'category_image'=>$path
    ]);
    return redirect()->route('Product-cat.index')->with('status', 'Category Is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodCat = ProductCategory::find($id);
        $img_path = public_path("storage/".$prodCat->category_image);
        if(file_exists($img_path)){
            @unlink($img_path);
        }
        $prodCat->delete();

        return redirect()->route('Product-cat.index')->with('deleted', 'Category Is Deleted Successfully');
    }

  
   
}
