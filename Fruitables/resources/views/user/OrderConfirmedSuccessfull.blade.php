@extends('user.include.master_file')
@section('title')
Order Confirmed
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Order Confirmed</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection
@section('body')




        <!-- 404 Start -->
        <div class="container-fluid py-5">
            <div class="container py-5 text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        {{-- <i class="bi bi-check-circle display-1 text-success"></i> --}}
                        <h1 class="display-1">Congrats!</h1>
                        <h1 class="mb-4">Your Order Is Now Confirmed and Sucessfully Placed</h1>
                        <p class="mb-4">Your Order Number is This: <strong>{{$order_Number}}</strong> </p>
                        <a class="btn border-secondary rounded-pill py-3 px-5" href="{{route('Shop.index')}}">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->

        @endsection