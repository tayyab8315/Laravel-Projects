<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Models\admin;
use App\Models\Product;
use App\Mail\VerifyAdmin;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        $count_user=User::where('email_verified_at','!=',null)->count();
        $count_product=Product::count();
        $count_orders=order::count();
        if (Auth::guard('admin')->check()) {
            $admin =Auth::guard('admin')->user();
            if($admin->role=='admin'){
                if( $admin->status=='enable'){
                    return view('admin.index',compact(['count_user','count_product','count_orders']));
                }elseif( $admin->status=='block'){
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.signin')->with('fail', 'Your Account is Blocked By Management');
                }else{
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.signin')->with('fail', 'Your Account is not Yet Activated');
                }
            } else if($admin->role=='super_admin'){

                return view('admin.index',compact(['count_user','count_product','count_orders']));
            }
        } else {
            return redirect()->route('admin.signin')->with('fail', 'You Must Login First');
        }

 
}

    public function manage_admin()
    {
        $admins = admin::where('role','admin')->paginate(5);
        $tasks = task::get();
        return view('admin.manage_admins',compact('admins','tasks'));
    }
    public function manage_Super_admin()
    {
        $admins = admin::where('role','super_admin')->paginate(5);
        $tasks = task::get();
        return view('admin.manage_super_admins',compact('admins','tasks'));
    }
    public function show()
    {
        return view('admin.signin');
    }
    public function forgetpass()
    {
        return view('admin.forget_pass');
    }
    public function verifyadmin(Request $request)
    {
   $admin = admin::where('email',$request->email)->first();
   if($admin){
Mail::to($admin->email)->send(new VerifyAdmin($admin->remember_token));
return redirect()->route('admin.signin')->with('status','Check Your Mail Account To Verify Mail');
} else {
    return redirect()->route('admin.signin')->with('fail', 'Email Doesnt Exists');
}
     
    }
    public function verified(string $token)
    {
        return view('admin.resetPass',compact('token'));
    }
    public function lastupd(Request $request ,string $token)
    {

        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);
        $password=Hash::make($request->password);
        $admin = admin::where('remember_token',$token)->first();
        // return $admin;
        $admin->update([
            'password'=> $password,
        ]);
        return redirect()->route('admin.signin')->with('status','Your Password Is Updated Successfully');
    }
    
    public function create()
    {
        return view('admin.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//    return $request;
 
      $validatedData = $request->validate([
           'name' => 'required|string|max:100',
           'email' => 'required|email|unique:admins,email',
           'image' => 'required|mimes:png,jpg,jpeg|max:30000',
           'password' => 'required|string|confirmed|min:8',
    
       ]);

       $image =$request->file('image');
       $filename = time().'.'.$image->getClientOriginalExtension();
      $path = $request->file('image')->storeAs('Images/Product',$filename,'public');
      $token = bin2hex(random_bytes(16)); // 8 bytes * 2 = 16 characters
      $password=Hash::make($request->password);
      admin::create([
       'name'=> $request->name,
       'email'=> $request->email,
       'password'=> $password,
       'profile_picture'=> $path,
       'role'=> 'admin',
       'status'=> 'disable',
       'task'=> 'null',
     'remember_token'=>$token 
               ]);

               return redirect()->route('admin.signin')->with('status','You Are Registered Successfully');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to authenticate with the admin guard
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index'); // Redirect to the admin dashboard or desired route
        } else {
            return redirect()->route('admin.signin')->with('fail', 'Incorrect Email or Password');
        }
    }
    
    


    public function task(string $id, string $task)
    {
        $admin = admin::find($id);
        $admin->update([
            'task'=>$task,
         ]);
         return redirect()->route('manage_admin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

     $admin = admin::find($id);
     if( $admin->status == 'disable'){
        $newstatus = 'enable';
     }else if($admin->status == 'enable'){
        $newstatus = 'block';
     }else{
        $newstatus = 'disable';
     }
     $admin->update([
        'status'=>$newstatus,
     ]);
     return redirect()->route('manage_admin');
    }

    public function make(string $id)
    {

     $admin = admin::find($id);
     if( $admin->role == 'admin'){
        $newstatus = 'super_admin';
        $admin->update([
            'role'=>$newstatus,
         ]);
         return redirect()->route('manage_admin');
     }else{
        $newstatus = 'admin';
        $admin->update([
            'role'=>$newstatus,
         ]);
         return redirect()->route('manage_Super_admin');
     }

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
        $admin = admin::find($id);
        $admin->delete();
        return redirect()->route('manage_admin');
    }

    public function signout()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
           
            return redirect()->route('admin.signin');
        }
    }
}
