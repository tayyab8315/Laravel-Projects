<?php

namespace App\Http\Controllers;

use App\Models\faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$faqs = faq::get();
return view('admin.manage_faqs',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_faqs');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
     $request->validate([
            'destination' => 'required|string',
            'CardDesc' => 'required'
        ]);
     
        faq::create([
'question'=>$request->destination,
'answer'=>$request->CardDesc,
'status'=>'block'
        ]);
        return redirect()->route('Faqs.index')->with('status','Faqs Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faqs = faq::find($id);
        return view('admin.update_faqs',compact('faqs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faqs = faq::find($id);
        $old_status = $faqs->status;

        if($old_status == 'block'){
            $newstatus ='unblock';
            // return   $newstatus;
        }else{
            $newstatus ='block';
        }
        $faqs->update([
            'status'=>$newstatus
                    ]);
    return redirect()->route('Faqs.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $validatedData = $request->validate([
            'destination' => 'required|string',
            'CardDesc' => 'required'
        ]);
        $faqs = faq::find($id);
        $faqs->update([
'question'=>$request->destination,
'answer'=>$request->CardDesc,
        ]);
        return redirect()->route('Faqs.index')->with('status','Faqs Updated Successfully');
//   return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faqs = faq::find($id);
        $faqs->delete();
        return redirect()->route('Faqs.index')->with('deleted','Faqs Deleted'); 
    }
}
