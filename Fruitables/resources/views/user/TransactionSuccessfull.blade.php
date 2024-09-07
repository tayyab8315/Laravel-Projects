@extends('user.include.master_file')
@section('title')
Order Successfull
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Order Successfull</h1>
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
                    <div class="col-lg-6">
                        {{-- <i class="bi bi-check-circle display-1 text-success"></i> --}}
                        <h1 class="display-1">Congrats!</h1>
                        <h1 class="mb-4">Your Order Is Sucessfully Placed</h1>
                        
                        <p class="mb-4">Your Order Number is  <strong>{{$ordernum}}</strong></p>
                        <p class="mb-4">Your Transaction id is This: <strong>{{$transid}}</strong></p>
                        <a class="btn border-secondary rounded-pill py-3 px-5" href="{{route('Shop.index')}}">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->

        @endsection