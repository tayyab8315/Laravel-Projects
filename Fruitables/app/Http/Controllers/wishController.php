<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Product;
use Illuminate\Http\Request;

class wishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // dd($request->data);
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
        //
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
}
