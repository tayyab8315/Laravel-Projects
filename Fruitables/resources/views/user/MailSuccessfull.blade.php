@extends('user.include.master_file')
@section('title')
Order Placed
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Order Placed</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('Cart.index')}}">Cart</a></li>
    <li class="breadcrumb-item"><a href="{{route('chackout')}}">Checkout</a></li>
</ol>
@endsection
@section('body')



        <!-- 404 Start -->
        <div class="container-fluid py-5">
            <div class="container py-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        {{-- <i class="bi bi-check-circle display-1 text-success"></i> --}}
    
                        <h1 class="mb-4">Your Order Is Placed</h1>
                        <p class="mb-4">Kindly Check Your Email For Order Confirmation  </p>
                        <p id="countdown">if You Not Yet Recieved Any Mail You can Resend Mail After: 2:00</p>
                        <button id="resendMail" class="btn border-secondary rounded-pill py-3 px-5 mx-auto" >Resend Email</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->

        @endsection