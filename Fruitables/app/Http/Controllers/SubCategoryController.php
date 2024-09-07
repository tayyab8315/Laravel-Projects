<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class SubCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        $prodcat= SubCategory::with('Cat')->get();      
        return (view('admin.manage_sub_cat',compact('prodcat')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodcat= ProductCategory::get();   
        return view('admin.add_sub_cat',compact('prodcat'));
    }

    /**
     * Store a newly created resource in storage.
      */
    public function store(Request $request)
    {
        $request->validate([
            'catName' => 'required|string|max:30',
            'catDesc' => 'required|string|max:300|min:40',
            'main_cat' => 'required|exists:product_categories,id', // Add validation rule for main_cat
   

        ]);
        // return $request->main_cat;
        SubCategory::create([
            'sub_category_name' => $request->catName,
            'sub_category_desc' => $request->catDesc,
            'cat_id' => $request->main_cat,
        ]);
        return redirect()->route('Product-Subcat.index')->with('status', 'Sub Category Is Added Successfully');
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $prodCattt = SubCategory::find($id);
        // $mainCategory = $prodCat->Cat;
        $prodcategory= ProductCategory::get();   
        return (view('admin.update_sub_cat',compact('prodCattt','prodcategory')));
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
        'catName' => 'required|string|unique:sub_categories,sub_category_name|max:30',
            'catDesc' => 'required|string|max:300|min:40',
            'main_cat' => 'required|exists:product_categories,id', // Add validation rule for main_cat
   

    ]);
    $prodCat = SubCategory::find($id);
    $prodCat->update([
        'sub_category_name' => $request->catName,
            'sub_category_desc' => $request->catDesc,
            'cat_id' => $request->main_cat,
    ]);
     return redirect()->route('Product-Subcat.index')->with('status', 'Sub Category Is Updated Successfully');
}

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id)
    {
        $prodCat = SubCategory::find($id);
        $prodCat->delete();

        return redirect()->route('Product-Subcat.index')->with('deleted', 'Sub Category Is Deleted Successfully');
    }
}
