@extends('user.include.master_file')
@section('title')
    User Details
@endsection

@section('banner')
<h1 class="text-center text-white display-6">User</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection

@section('body')

<!-- Single Page Header End -->
<div class="custom-container">
    <div class="custom-content">
        <div class="custom-row align-items-center">
            <div class="custom-avatar-col text-center">
                <img src="{{'storage/'.Auth::user()->profile_picture}}" alt="User Avatar" class="custom-user-avatar">
                {{-- {{'storage/'.$feature->image}} --}}
            </div>
            <div class="custom-info-col">
                <h2 class=" text-primary">About Me</h2>
                <h4 class="text-warning">{{Auth::user()->name}}</h4>
        
                <div class="custom-info-row">
             
                    <div class="custom-info-col-half">
                        <p><strong>E-mail:</strong> {{Auth::user()->email}}</p>
                        <a href="{{route('Order_history')}}" class="btn btn-primary mt-5 w-100">Order History</a>
                    </div>
                    
                </div>
                
            </div>
        </div>
        <a href="{{route('logout')}}" class="btn btn-primary mt-5 w-100">Logout</a>
    </div>
    
</div>

@endsection
