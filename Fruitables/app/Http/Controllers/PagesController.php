<?php
namespace App\Http\Controllers;

use App\Models\faq;
use App\Models\term;
use App\Models\about_u;
use App\Models\contact;

use App\Models\web_detail;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $webdetails = web_detail::first();
        return view('user.contact',compact('webdetails'));
    }
    public function display_terms()
    {
     $terms_conditions = term::get();
        return view('user.terms_conditions',compact('terms_conditions'));
    }
    public function display_refund()
    {
     $terms_conditions = term::get();
        return view('user.refund_policy',compact('terms_conditions'));
    }
    public function display_privacy()
    {
     $terms_conditions = term::get();
        return view('user.privacy_policy',compact('terms_conditions'));
    }
    public function policy_form()
    {
return view('admin.update_terms_and_conditions');
    }
    public function display_faqs()
    {
        $faqs =faq::where('status','unblock')->get();
return view('user.Faqs',compact('faqs'));
    }
    
    public function terms_conditions(Request $request)
    {
$term=term::find($request->rowNumber);
return response()->json($term) ;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.update_about_us');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:300',
     
        ]);
        contact::create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'message' =>  $request->message,  
            'status'=>'unread',
        ]);
        return redirect()->route('pages.index')->with('success','Your Message is Send To Website Manager');
    }

    public function teamdetails(Request $request)
    {
     $result  = about_u::find($request->rowNumber);
        return response()->json($result) ;
    }

    public function show(string $id)
    {
        //
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
    public function about_us_modified(Request $request)
    {
    //   return  $request;

      $request->validate([
        'CardTit' => 'required|string|max:30',
        'destination' => 'required|string|max:30',
        'CardIcon' => 'mimes:png,jpg,jpeg|max:30000',
        'CardDesc' => 'required|string',
    ]);
    $prodCat = about_u::find($request->row);

    if($request->hasFile('CardIcon')){
    $img_path = public_path("storage/".$prodCat->image);
    if(file_exists($img_path)){
        @unlink($img_path);
    }
$image =$request->file('CardIcon');
$filename = time().'.'.$image->getClientOriginalExtension();
$path = $request->file('CardIcon')->storeAs('Images/Product',$filename,'public');
}else{
    $path = $prodCat->image;
}

$prodCat->update([
    'name'=>  $request->CardTit,
    'destination'=>  $request->destination,
    'image'=>$path,
    'page_description'=>$request->CardDesc,
]);
return redirect()->route('pages.create')->with('success', 'About Us Page Updated Successfully');

    }

    public function terms_modified(Request $request)
    {
    //   return  $request;

      $request->validate([
        'CardDesc' => 'required|string',
    ]);
    $prodCat = term::find($request->row);

$prodCat->update([
    'terms_conditions'=>$request->CardDesc,
]);
return redirect()->route('policy_form')->with('success', 'Term and Conditions Page Updated Successfully');

    }

    public function update(Request $request)
    {
    //   return  $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
