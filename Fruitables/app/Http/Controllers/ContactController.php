<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $contacts = contact::get();
     return view('admin.manage_contacts',compact('contacts'));
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
        //
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
//   return $id;
  $faqs = contact::find($id);
  $old_status = $faqs->status;

  if($old_status == 'unread'){
      $newstatus ='read';
      // return   $newstatus;
  }else{
      $newstatus ='unread';
  }
  $faqs->update([
      'status'=>$newstatus
              ]);
              return redirect()->route('contacts.index');
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
        $faqs = contact::find($id);
        $faqs->delete();
        return redirect()->route('contacts.index')->with('deleted','Contact Message Deleted'); 
    }
    
}
