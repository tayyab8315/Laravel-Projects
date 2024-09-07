@extends('user.include.master_file')
@section('title')
Cart
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Cart</h1>
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
                @if (count($cart) > 0)
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
               
                        @foreach ($cart as $productId => $details)
                        <tr class="product" id="cartrow">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('storage/'.$details['Pimage'])}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{ $details['Pname'] }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price">{{ number_format($details['Pprice'], 2) }} </p>
                            </td>
                            <td>
                                <div class="input-group mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border decrease">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    {{-- <input type="text" name="" class="prodcut_id" value=""> --}}
                                    <input type="text" min="1" class="form-control form-control-sm text-center border-0 quantity" product="{{$details['Product'] }}" value="{{ $details['Pquantity'] }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border increase">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $totalprice = $details['Pprice'] * $details['Pquantity']; 
                                    $ordertotal  =    $ordertotal + $totalprice; 

                                @endphp
                                <p class="mb-0 mt-4 total_price">{{ number_format($details['Pprice'] * $details['Pquantity'], 2) }} </p>
                            </td>
                            <td>
                                <a  data-prodid="{{$details['Product']}}" class="btn btn-md rounded-circle bg-light border mt-4 " id="removecart">
                                    <i class="fa fa-times text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <h1 class="text-center text-primary">Your cart is empty.</h1>
                    @endif
                </tbody>
            </table>
        </div>
        @if (count($cart) > 0)
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
           
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0" id="flat_rate">{{ $ordertotal }} $</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: $3.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id="order_amount">{{ $ordertotal + 3 }} $</p>
                    </div>
                
                    <a href="{{route('chackout')}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</a>
             
                </div>
            </div>

        


        </div>
          @endif
    </div>
</div>
<!-- Cart Page End -->
<script>


    // Pass the route URL from Blade to JavaScript
    var updateCartUrl = '{{ route("Cart.updatecart") }}';
    var Showpro = '{{ route("Cart.Showpro") }}';
  
</script>

@endsection
