@extends('user.include.master_file')
@section('title')
Transaction Error
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Transaction Error</h1>
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
                    <div class="col-lg-8">
                        <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                        <h1 class="display-1">Sorry!</h1>
                        <h1 class="mb-4">Your Order Can't Be Placed</h1>
                        <p class="mb-4">{{ $transerror }}</p>  
                        <a class="btn border-secondary rounded-pill py-3 px-5" href="{{route('Shop.index')}}">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->
        @endsection