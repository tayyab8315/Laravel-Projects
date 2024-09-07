<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        
        $cart = session()->get('cart', []);

        return view('user.cart', compact('cart'));

    }


    public function store(Request $request)
    {
        
        $productId = $request->send[0];
        $quantity = $request->send[1];
     
        try {
       

            $cart = session()->get('cart', []);
            $product = Product::find($productId);
            
    
                if (isset($cart[$productId])) {
    
                    $cart[$productId]['Pquantity'] += $quantity;
                } else {
    
                    $cart[$productId] = [
                        'Product' => $productId,
                        'Pquantity' => $quantity,
                        'Pname' => $product->name, 
                        'Pprice' => $product->price,
                        'Pimage' => $product->image,
                    ];
                }
    
                session()->put('cart', $cart);
                $itemCount = count($cart);
                return response()->json([
                    'success' => true,
                    'comingdata' => $itemCount ,
                    'operation'=>'cart',
                    'message'=> 'item is added to cart',
                   
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error fetching products.',
                    'error' =>  $e->getMessage()
                ], 500);
            }

    }


    public function create()
    {

        session()->forget('cart');
    

        session()->flash('success', 'Cart cleared successfully.');

        return redirect()->route('Cart.index');
    }
    
    public function updatecart(Request $request)
    {
        $cart = session()->get('cart', []);
  
        $quantity = $request->input('quantity');
        $productId = $request->input('productId');
    

        if (isset($cart[$productId])) {

            $cart[$productId]['Pquantity'] = $quantity;
    
            session()->put('cart', $cart);
    
       
            return response()->json([
                'success' => true,
                'message' => 'Product quantity updated successfully!',
                'quantity' => $quantity,
                'productId' => $productId
            ]);
        } else {
   
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart.'
            ]);
        }
    }
    
    public function destroy(string $id)
    {

        try {
               $cart = session()->get('cart', []);
               if (isset($cart[$id])) {

                unset($cart[$id]);
 
                session()->put('cart', $cart);
                $itemCount = count($cart);
              
            } 
                    return response()->json([
                        'success' => true,
                        'comingdata' => $itemCount ,
                        'operation'=>'cart',
                        'message' => 'Item is Removed from Cart',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error fetching products.',
                        'error' => $e->getMessage()
                    ], 500);
                }

    }

public function cartcount(){
    
    try {
        $cart = session()->get('cart', []);
         $itemCount = count($cart);
             return response()->json([
                 'success' => true,
                 'comingdata' => $itemCount ,
                 'operation'=>'cart',
                 'message'=>'no'

             ]);
         } catch (\Exception $e) {
             return response()->json([
                 'success' => false,
                 'message' => 'Error fetching products.',
                 'error' => $e->getMessage()
             ], 500);
         }

}
    public function wishcount(){
        
        try {
            $userId = Auth::id();
                 $totalwish =  wishlist::where('user_id', $userId)->count();
                 if($totalwish <= 0){
                    $totalwish = 0; 
                }
                    return response()->json([
                        'success' => true,
                        'comingdata' => $totalwish ,
                        'operation'=>'wishlist',
                        'message'=>'no'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error fetching products.',
                        'error' => $e->getMessage()
                    ], 500);
                }
    }
    public function removewishlist(string $id)
    {

        try {
            $userId = Auth::id();
    
            $wishlist = wishlist::where('user_id', $userId)
                                ->where('product_id', $id)
                                ->first();
                 $wishlist->delete();
                 $totalwish =  wishlist::where('user_id', $userId)->count();
                 if($totalwish <= 0){
                    $totalwish = 0; 
                }
                    return response()->json([
                        'success' => true,
                        'comingdata' => $totalwish ,
                        'operation'=>'wishlist',
                        'message' => 'Item is Removed from Wishlist',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error fetching products.',
                        'error' => $e->getMessage()
                    ], 500);
                }

    }


    public function wishlist(string $productId)
    {
        try {
            $userId = Auth::id();
    
            $wishlist = Wishlist::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();
    
            if ($wishlist) {
                $message = "Item is already in your wishlist";
            } else {
                Wishlist::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                ]);
                $message = "Item has been added to your wishlist";
            }
          $totalwish =  wishlist::where('user_id', $userId)->count();
    if($totalwish <= 0){
        $totalwish = 0; 
    }
            return response()->json([
                'success' => true,
                'comingdata' => $totalwish,
                'operation' => 'wishlist',
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function show(){
        $wishlist = Wishlist::where('user_id',Auth::id())->with('wishlistfromuser')->with('wishlistfromproduct')->get();

        return view('user.wishlist',compact('wishlist'));
        // return $wishlist;

    }


    public function Showpro(){

    $cart = session()->get('cart', []);
    $totalAmount = 0;
    foreach ($cart as $productId => $details) {
        $totalAmount += $details['Pprice'] * $details['Pquantity'];
        
    }

    return response()->json([
        'success' => true,
        'totalAmount' => $totalAmount
    ]);
}
public function chackout(){
    $cart = session()->get('cart', []);

    return view('user.chackout', compact('cart'));
}
}
