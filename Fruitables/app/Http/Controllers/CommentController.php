<?php

namespace App\Http\Controllers;

use DB;
use App\Models\comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Comments = comment::with('commentprod')->get();
        return view('admin.manage_comments',compact('Comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $isertCommnet = comment::create([
    'name' =>     $request->name,  
     'review' =>     $request->review,
    'rating' =>     $request->rating,  
    'status' => "Show",  
    'product_id' =>     $request->prodct_id,  
    'user_id' =>  Auth::id(),
     
]);


$averageRating = Comment::where('product_id', $request->prodct_id)->avg('rating');
$product=Product::find($request->prodct_id);
$product->update([
    'avg_rating' =>$averageRating,   
]);
return redirect()->route('Shop.edit', ['id' =>  $request->prodct_id]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faqs = comment::find($id);
        $old_status = $faqs->status;

        if($old_status == 'Show'){
            $newstatus ='hide';
            // return   $newstatus;
        }else{
            $newstatus ='Show';
        }
        $faqs->update([
            'status'=>$newstatus
                    ]);
    return redirect()->route('Review.index');
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
        $review = comment::find($id);
        $review->delete();
        return redirect()->route('Review.index')->with('deleted','Faqs Deleted'); 
    }
}
