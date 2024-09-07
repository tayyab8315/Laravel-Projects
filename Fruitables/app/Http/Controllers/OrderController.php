<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\Payment;
use App\Models\order_item;
use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = order::with(['user','product','payment','Order_items'])->Paginate(10);
        
        return (view('admin.manage_orders',compact('orders')));
    }

   public function Order_details(string $order_status)
    {
        $orders = order::where('order_status', $order_status)->with(['user','product','payment','Order_items'])->Paginate(10);
        
        return (view('admin.manage_orders',compact('orders','order_status')));
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
        
        $validatedData =$request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company_name' => 'nullable|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'postcode' => 'required|string|max:20',
        'mobile' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'ship_to_different_address' => 'nullable|boolean',
        'payment_method' => 'required|string',
        // Add more validation rules as needed
    ]);
    // if( $validatedData['payment_method']=='paypal'){

    // }
    $Order_number = random_int(10000000, 99999999);

      // Insert data into the orders table
      $order = order::create([
        'user_id' =>  Auth::id(), // Assuming authenticated user
        'product_id' => 1, // Example product_id, adjust as needed
        'order_number' => $Order_number,
        'order_status' => "Pending",
        'first_name' => $validatedData['first_name'],
        'last_name' => $validatedData['last_name'],
        'company_name' => $validatedData['company_name'],
        'address' => $validatedData['address'],
        'city' => $validatedData['city'],
        'country' => $validatedData['country'],
        'postcode' => $validatedData['postcode'],
        'mobile' => $validatedData['mobile'],
        'email' => $validatedData['email'],
        'ship_to_different_address' => $request->different_address,
        'payment_method' => $validatedData['payment_method'],
        'order_confirmed_at' =>Null,
    ]);

    
    $cart = session()->get('cart', []);

    foreach ($cart as $productId => $details) {
        $orderitems = order_item::create([
            'order_number' =>$Order_number,  
             'product_id' => $details['Product'],
            'product_quantity' =>$details['Pquantity']  
          
        ]);
    }
    

if($validatedData['payment_method'] == "paypal"){
    return redirect()->route('payment',['Price'=>$request->order_total,'order_number' =>$Order_number]);
}else{
    $sendername=$validatedData['first_name']." ".$validatedData['last_name'];
    $mail = Mail::to($validatedData['email'])->send(new OrderConfirmation($cart,$sendername,$Order_number));
    return (view('user.MailSuccessfull',['order_number'=>$Order_number]));
 

}

}




    

    /**
     * Display the specified resource.
     */
    public function show(string $order_num)
    {

        $transaction = Payment::where('order_number', $order_num)->first();
      
        return (view('admin.OrderTransactionsDetails',compact('transaction')));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $order_num)
    {
        // return $order_num;
        
        $prod_items = order_item::where('order_number', $order_num)->with('include_products')->Paginate(10);
      
        return (view('admin.orderinclusion',compact('prod_items')));
        // return $transaction;
        
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
    public function verifymail(string $order_number)
    {
        // return $order_number;
        $order = Order::where('order_number', $order_number)->first();
        $order->update([
            'order_confirmed_at'=>now(),
        ]);
        return (view('user.OrderConfirmedSuccessfull',['order_Number'=>$order_number]));
       
    }
    function user_details(string $order_number){
        $user = order::where('order_number', $order_number)->first();
        return (view('admin.OrderUserDetails',compact('user')));
    }

    public function order_status(string $order_number, string $order_stat) {
        // return $order_number;
        // Retrieve the order using the provided order number
        $user = Order::where('order_number', $order_number)->first();
    
        // Check if the order was found
        if ($user === null) {
            // Handle the case where the order is not found
            return "No Results Found";
        }
    
        // Determine the new status based on the current status
        if ($user->order_status == 'Pending') {
            $newStatus = 'Preparing';
        } elseif ($user->order_status == 'Preparing') {
            $newStatus = 'Delivered';
        } else {
            $newStatus = 'Pending';
        }
    
        // Update the order status
        $user->update([
            'order_status' => $newStatus
        ]);
    
        // Redirect to the order details route with the updated order status
        return redirect()->route('Order_details', ['order_number' => $order_number, 'order_status' => $order_stat]);
    }

    public function search_order(Request $request){
 try{

// order::where('name', 'LIKE', "%{$request->send}%")->where('user')
$userid = Auth::id();
$orderNumber = $request->send;
if($orderNumber==''){
    $order = order::where('user_id',$userid)
    ->with('order_items')
    ->with('order_items.include_products')
    ->with('payment')
    ->get();
}else{
    $order = order::where('order_number','LIKE', "%{$orderNumber}%")->where('user_id',$userid)
    ->with('order_items')
    ->with('order_items.include_products')
    ->with('payment')
    ->get();
}

        return response()->json([
            'success' => true,
            'comingdata' => $order ,
            'operation' => 'order',
            'message' => 'no Message',
        ]);
        } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error processing request.',
            'error' => $e->getMessage(),
        ], 500);
        }
        
    }
    
    
}
