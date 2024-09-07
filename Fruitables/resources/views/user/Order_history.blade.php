@extends('user.include.master_file')
@section('title')
User Orders
@endsection
@section('banner')
<h1 class="text-center text-white display-6">User Orders</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('userdetail')}}">User</a></li>
</ol>
@endsection
@section('body')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row mb-3">
            <div class="col-xl-8">
            </div>
            <div class="col-xl-4">
                <div class="input-group w-100 mx-auto d-flex">
                    <input type="search" value="" class="form-control p-3" id="OrderSearch" placeholder="Order Number" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table id="orderTable" class="table">
                @if (!empty($user->userorder))
                <thead>
                    <tr class="product text-center">
                        <th scope="col">Order Number</th>
                        <th scope="col">Order Confirmed</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Order Time</th>
                        <th scope="col">Delivery Address</th>
                        <th scope="col">Order Details</th>
                        <th scope="col">Payment Details</th>
                    </tr>
                </thead>
                <tbody id="order-tbl">
                    @foreach ($user->userorder as $order)
                    <tr class="product text-center">
                        <th scope="row">
                            <p class="mb-0 mt-4">
                                {{ $order->order_number }}
                            </p>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">
                                @if (is_null($order->order_confirmed_at))
                                Not Confirmed
                                @else
                                Confirmed
                                @endif
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 price">
                                {{ $order->order_status }}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 price">
                                @if ($order->payment_method == 'paypal')
                                Paypal
                                @else
                                Cash On Delivery
                                @endif
                            </p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 price">
                                {{ $order->created_at }}
                            </p>
                        </td>
                        <td>
                            <button class="btn fs-1 text-primary px-2 py-0 rounded-circle bg-light" data-bs-toggle="modal" data-bs-target="#staticBackdropDelivery{{ $order->order_number }}">
                                &#128065;
                            </button>
                        </td>
                        <td>
                            <button class="btn fs-1 text-primary px-2 py-0 rounded-circle bg-light" data-bs-toggle="modal" data-bs-target="#staticBackdropOrder{{ $order->order_number }}">
                                &#128065;
                            </button>
                        </td>
                        <td>
                            <button class="btn fs-1 text-primary px-2 py-0 rounded-circle bg-light" data-bs-toggle="modal" data-bs-target="#staticBackdropPayment{{ $order->order_number }}">
                                &#128065;
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <h1 class="text-center text-primary">You Have Not Placed Any Orders Yet</h1>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Delivery -->
    @foreach ($user->userorder as $order)
    <div class="modal fade " id="staticBackdropDelivery{{ $order->order_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content user-modal">
                <div class="modal-header ">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Delivery Address Details for Order {{ $order->order_number }}</h5>
                    <button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>First Name:</strong> {{ $order->first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $order->last_name }}</p>
                    <p><strong>Company Name:</strong> {{ $order->company_name }}</p>
                    <p><strong>Address:</strong> {{ $order->address }}</p>
                    <p><strong>City:</strong> {{ $order->city }}</p>
                    <p><strong>Country:</strong> {{ $order->country }}</p>
                    <p><strong>Postcode:</strong> {{ $order->postcode }}</p>
                    <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Order Details -->
    @foreach ($user->userorder as $order)
    <div class="modal fade user-modal" id="staticBackdropOrder{{ $order->order_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content user-modal">
                <div class="modal-header text-white">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Order Details for Order {{ $order->order_number }}</h5>
                    <button type="button" class="btn-close bg-light btn-light  text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="orderDetailsTable{{ $order->order_number }}" class="table text-white">
                        <thead>
                            <tr class="product text-center">
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->order_items as $item)
                            <tr class="product text-center">
                                <td>
                                    <img height="70px" width="70px" src="{{ asset('storage/'.$item->include_products->image) }}" alt="{{ $item->include_products->name ?? 'Unknown Product' }}" class="rounded-circle">
                                </td>
                                <td class=" pt-4">
                                    {{ $item->include_products->name ?? 'Unknown Product' }}
                                </td>
                                <td class=" pt-4">
                                    {{ $item->product_quantity }}
                                </td>
                                <td class=" pt-4">
                                    {{ $item->include_products->price ?? '0.00' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Payment Details -->
    @foreach ($user->userorder as $order)
    <div class="modal fade " id="staticBackdropPayment{{ $order->order_number }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content user-modal">
                <div class="modal-header">
                    <h5 class="modal-title  text-white" id="staticBackdropLabel">Payment Details for Order {{ $order->order_number }}</h5>
                    <button type="button" class="btn-close bg-light btn-light  text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Payment Status:</strong> {{ $order->order_status }}</p>
                    @if ($order->payment)
                    <p><strong>Transaction ID:</strong> {{ $order->payment->payment_id ?? 'N/A' }}</p>
                    <p><strong>Customer ID:</strong> {{ $order->payment->payer_id ?? 'N/A' }}</p>
                    <p><strong>Customer Email:</strong> {{ $order->payment->payer_email ?? 'N/A' }}</p>
                    <p><strong>Amount Paid:</strong> {{ $order->payment->amount ?? 'N/A' }}</p>
                    <p><strong>Payment Date:</strong> {{ $order->payment->created_at ?? 'N/A' }}</p>
                    @else
                    <p>No payment details available.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
<!-- Cart Page End -->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        // Initialize DataTable for the main orders table
        $('#orderTable').DataTable();

        // Initialize DataTable for each order details table after a slight delay
        @foreach ($user->userorder as $order)
        setTimeout(function() {
            $('#orderDetailsTable{{ $order->order_number }}').DataTable();
        }, 500);
        @endforeach
    });
</script>

@endsection
