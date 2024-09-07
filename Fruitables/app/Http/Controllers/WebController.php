<?php

namespace App\Http\Controllers;
use App\Models\home_page_Banner;
use App\Models\web_detail;
use App\Models\website_properties_card;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Banner= home_page_Banner::get(); 
        // return $Banner ;
        return (view('admin.update_web_banner',compact(['Banner'])));
    }
    public function show()
    {
      
            $Website_details = web_detail::get(); 
            return (view('admin.update_web_details',compact(['Website_details'])));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return (view('admin.update_web_Cards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $row =$request->rowNumber;  
        $card =$request->cardNumber;  
        if($row == 2){
            $card = $card+4;
        }elseif($row == 3){
            $card = $card+8;  
        }elseif($row == 4){
            $card = $card + 11;  
        }elseif($row == 5){
            $card = $card + 12;  
        }elseif($row == 6){
            $card = $card + 13;  
        }

        $updCards = website_properties_card::find($card);
     return response()->json($updCards) ;
    }

    /**
     * Display the specified resource.
     */
    public function updateCard(Request $request)
    {
    
        if($request->row==5){
$titvalid ='string|max:255';
        }else{
            $titvalid ='required|string|max:255';
        }

        if($request->row==6){
            $descvalid ='string|max:1000';
            $titvalid ='string|max:255';
                    }else{
                        $descvalid ='required|string|max:1000';
                        $titvalid ='required|string|max:255';
                    }

      $validatedData = $request->validate([
        'row' => 'required|string|max:255',
        'CardNumber' => 'required|string|max:255',
        'CardTit' => $titvalid,
        'CardIcon' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        'CardDesc' => $descvalid,
      ]);
      $CardTit = $request->CardTit;
      if (empty($CardTit)) {
          $CardTit = 'Null';
      }
      
      $card= $request->CardNumber;
      if( $request->row == 2){
        $card= $request->CardNumber + 4;
      }elseif($request->row == 3){
        $card= $request->CardNumber + 8;
      }elseif($request->row == 4){
        $card= $request->CardNumber + 11;
      }elseif($request->row == 5){

        $card= $request->CardNumber + 12;
      }elseif($request->row == 6){

        $card= $request->CardNumber + 13;
      }
      $updCards = website_properties_card::find($card);
      if($request->hasFile('CardIcon')){
        $image =$request->file('CardIcon');
        $filename = time().'.'.$image->getClientOriginalExtension();
       $path = $request->file('CardIcon')->storeAs('Images/Product',$filename,'public');
       $img_path = public_path("storage/".$updCards->icon);
       if(file_exists($img_path)){
           @unlink($img_path);
       }
      }else{
        $path = $updCards->icon;
      }
    
 
       $updCards->update([
        'icon' => $path,
        'title' => $CardTit,
        'Description' => $request->CardDesc
      ]) ;
      return redirect()->route('Web.create')->with('success','Card '.$card.' Updated Successfully');
    }

    public function Info_Update(Request $request, string $id)
    {
        
        $request->validate([
            'Name' => 'required|string|max:30',
            'webemail' => 'required|string|max:30',
            'phone' => 'required|string|max:30',
            'Address' => 'required|string|max:30',
            'CardDesc' => 'required|string',
        ]);
        // return  $request;
        $Banner = web_detail::find($id);
        $Banner->update([
            'name' => $request->Name,
            'email' => $request->webemail,
            'phone' => $request->phone,
            'address' => $request->Address,
            'additional_info' => $request->CardDesc,
        ]);
        return redirect()->route('web_info')->with('success', 'Website Details are Updated Successfully');
    }
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
            'BannerTit' => 'required|string|max:30',
            'BannerImg' => 'mimes:png,jpg,jpeg|max:30000',
            'BannerDesc' => 'required|string|max:3000',
        ]);
        $Banner = home_page_Banner::find($id);
    
        if($request->hasFile('BannerImg')){
        $img_path = public_path("storage/".$Banner->Banner_image);
        if(file_exists($img_path)){
            @unlink($img_path);
        }
    $image =$request->file('BannerImg');
    $filename = time().'.'.$image->getClientOriginalExtension();
    $path = $request->file('BannerImg')->storeAs('Images/Product',$filename,'public');
    }else{
        $path = $Banner->Banner_image;
    }
        $Banner->update([
            'Banner_Title'=>  $request->BannerTit,
            'Banner_image'=>   $path ,
            'Banner_Desc'=>$request->BannerDesc,
        ]);
        return redirect()->route('Web.index')->with('success', 'Banner Is Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
