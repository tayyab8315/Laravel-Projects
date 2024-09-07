@extends('user.include.master_file')
@section('title')
Wishlist
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Wishlist</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection
@section('body')
@php
      $ordertotal = 0 ;
@endphp

<!-- Single Page Header End -->

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                @if (count($wishlist) > 0)
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th class=" ps-4" scope="col">Quantity</th>
                        <th scope="col">Remove</th>
                        <th scope="col">Cart</th>
                    </tr>
                </thead>
                <tbody>
               
                        @foreach ($wishlist as  $details)
                        <tr class="product "  id="cartrow">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('storage/'.$details->wishlistfromproduct->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{ $details->wishlistfromproduct['name'] }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price">{{ number_format($details->wishlistfromproduct['price'], 2) }} </p>
                            </td>
                            <td>
                                <div class="input-group mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border decrease">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" min="1" class="form-control form-control-sm text-center border-0 quantity" product="{{$details->wishlistfromproduct['id']}}" value="1" >
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border increase">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a  data-prodid="{{$details->wishlistfromproduct['id']}}" class="btn btn-md rounded-circle bg-light border mt-4 " id="removewish">
                                    <i class="fa fa-times text-danger"></i>
                                </a>
                            </td>
                            <td>
                                <a  class="btn btn-md rounded-circle bg-light border mt-4 " id="addtocart">
                                    <i class="fa fa-shopping-bag text-primary"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <h1 class="text-center text-primary">Your Wishlist is empty.</h1>
                    @endif
                </tbody>
            </table>
        </div>
       
    </div>
</div>


@endsection
