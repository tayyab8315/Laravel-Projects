<?php

namespace App\Http\Controllers;

use App\Mail\Verify_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|mimes:png,jpg,jpeg|max:30000',
            'password' => 'required|string|confirmed|min:8',
     
        ]);
      


        $image =$request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
       $path = $request->file('image')->storeAs('Images/Product',$filename,'public');
       $token = bin2hex(random_bytes(16)); // 8 bytes * 2 = 16 characters

       User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> $request->password,
        'profile_picture'=> $path,
        'role'=>'user',
      'remember_token'=>$token 
                ]);

                Mail::to($request->email)->send(new Verify_User($request->name,$token,'verify_mail'));
                return (view('user.wait_formail',compact('token')));


    }

    /**
     * Display the specified resource.
     * 
     */
    public function gotoGoogle(){
return Socialite::driver('google')->redirect();
    }

    public function returnfromGoogle(){
      
        try{

$google_user=Socialite::driver('google')->user();
// return $google_user;
       $user = User::where('google_id', $google_user->getId())->orwhere('email',$google_user->getEmail())->first();
       $token = bin2hex(random_bytes(16)); // 8 bytes * 2 = 16 characters
       $path='Images/Product/google.png';
if(!$user){
    User::create([    
    'name'=>$google_user->getName(),
    'email'=>$google_user->getEmail(),
    'google_id'=>$google_user->getId(),
    'password'=> 'xxxxxxxxxxxxxxxxxxxxx',
    'profile_picture'=> $path,
    'email_verified_at'=> now(),
    'role'=>'user',
  'remember_token'=>$token
 ]);

Auth::login($user);
    return redirect()->route('index');


}else{

    Auth::login($user);
    return redirect()->route('index');
}
        }catch(\Throwable $th){
dd('Somenthing Went Wrong'.$th->getMessage());
        }
            }

            public function gotofacebook(){
                return Socialite::driver('facebook')->redirect();
                    }
                
                    public function returnfromfacebook(){
                      
                        try{
                
                $google_user=Socialite::driver('facebook')->user();
                // return $google_user;
                       $user = User::where('facebook_id', $google_user->getId())->orwhere('email',$google_user->getEmail())->first();
                       $token = bin2hex(random_bytes(16)); // 8 bytes * 2 = 16 characters
                       $path='Images/Product/google.png';
                if(!$user){
                    User::create([    
                    'name'=>$google_user->getName(),
                    'email'=>$google_user->getEmail(),
                    'google_id'=>$google_user->getId(),
                    'password'=> 'xxxxxxxxxxxxxxxxxxxxx',
                    'profile_picture'=> $path,
                    'email_verified_at'=> now(),
                    'role'=>'user',
                  'remember_token'=>$token
                 ]);
                
                Auth::login($user);
                    return redirect()->route('index');
                
                
                }else{
                
                    Auth::login($user);
                    return redirect()->route('index');
                }
                        }catch(\Throwable $th){
                dd('Somenthing Went Wrong'.$th->getMessage());
                        }
                            }

    public function show($token,$task)
    {
        if($task=='verify_mail'){
            $user = User::where('remember_token', $token)->first();
            $user->update([
    'email_verified_at'=>now(),
            ]);
            return redirect()->route('user.index')->with('status','Email Is Verfied Successfully, Now You Can Login');
        }else{
            return (view('user.UpdatePassword',compact('token'))); 
        }

     
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
    public function update(Request $request, string $token)
    {
       $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);
        $user = User::where('remember_token', $token)->first();
        $user->update([
            'password'=> $request->password,
                    ]);
                    return redirect()->route('user.index')->with('status','Password Updated Now You Can Login With New Password');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function sendmail(Request $request){
     $token=$request->token;
     $user = User::where('remember_token', $token)->first();
   
        Mail::to($user->email)->send(new Verify_User($user->name, $token,'verify_mail'));
        return (view('user.wait_formail',compact('token')));

    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        } else {
            return redirect()->route('user.index')->with('fail', 'Incorrect Email Or Password');
        }
    }
    
      


       public function resetForm(){
       
        return view('user.forget_password');

       }
       public function UpdatePassword($token){
    return $token;
       
        return view('user.forget_password');

       }

       public function reset(Request $request){
    
       $request->validate([
            'email' => 'required',
     
        ]);
        $user = User::where('email',$request->email)->first();
if($user){
    $token=$user->remember_token;
    Mail::to($user->email)->send(new Verify_User($user->name, $token,'updatepass'));
    return (view('user.wait_formail',compact('token')));
}else{
    return redirect()->route('user.index')->with('fail','This Email Or Does Not Exists');
}
 
}
    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('user.index');
        }
    }
    public function Order_history(){
        if(Auth::check()){
            $userid = Auth::id();
            $user = User::with('userorder')
            ->with('userorder.order_items')
            ->with('userorder.payment')
            ->with('userorder.order_items.include_products')
            ->find($userid);
             
            // return $user ;
            return view('user.order_history', compact('user')); // Assuming 'order_history' is your view name
        } else {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }
    
public function subscription(Request $request){
try{
    $user = User::find(Auth::id());
    if($user->subscription == null){
      $user->update([
        'subscription'=>$request->send,
      ]);
      $message = "You have Successfully Subscribed";
    }else{
        $message = "You have Already Subscribed";
    
    };


    
    return response()->json([
    'success' => true,
    'comingdata' => $request->send,
    'operation' => 'subscription',
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

}

