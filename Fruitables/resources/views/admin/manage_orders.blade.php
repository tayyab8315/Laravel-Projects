
@extends('admin.include.master_file')
@section('title')
Orders
@endsection
@section('body')


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    @if (null !== session('status'))
                    <div id="alertBox" class="alert alert-success" role="alert">
                        {{session('status')}}
                      </div>
                    @endif
                    @if (null !== session('deleted'))
                    <div id="alertBox" class="alert alert-danger" role="alert">
                        {{session('deleted')}}
                      </div>
                    @endif
                   
                    <div class="position-relative mb-3 text-start ">
                        @if(isset($order_status))
                        <h3 class="mb-4 d-inline">{{$order_status}} Orders</h3>        
                            
                        @else
                        <h3 class="mb-4 d-inline">Manage Orders</h3>        
@endif
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Order Number</th>
                                    <th scope="col">Order Confirmed</th> 
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Order Status</th>                      
                                    <th scope="col">Delivery Details</th>
                                    <th scope="col">Order Inclusion</th> 
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{$order->first_name." ".$order->last_name}}</td>
                                    <td>{{$order->order_number}}</td>
                                    @php
                                    if (is_null($order->order_confirmed_at)) {

                                    $confirm="No";
                                    } else {
                                        $confirm="Yes";

                                    }
                                @endphp
                                <td>{{$confirm}}</td>
                                @php
                                if($order->payment_method == 'paypal') {
                                    $paymethod = '<a href="' . route('Order.show', ['order_num' => $order->order_number]) . '" class="btn btn-light">PayPal</a>';
                                } else {
                                    $paymethod = 'COD';
                                }
                            @endphp
                                <td>{!! $paymethod !!}</td> 
                                @if ($order->order_status == 'Pending')
                                <td><a href="{{route('order_status',['order_status'=>$order->order_status,'order_number'=>$order->order_number])}}" class=" btn btn-primary">{{$order->order_status}}</a></td>
                                @elseif($order->order_status == 'Preparing')
                                <td><a href="{{route('order_status',['order_status'=>$order->order_status,'order_number'=>$order->order_number])}}" class="btn btn-warning">{{$order->order_status}}</a></td>
                                @else
                                <td><a href="{{route('order_status',['order_status'=>$order->order_status,'order_number'=>$order->order_number])}}" class="btn btn-success">{{$order->order_status}}</a></td>
                                @endif
                                    <td><a href="{{route('user_details',['order_number'=>$order->order_number])}}" class="nav-link btn btn-dark">Check</a></td>                               
                                    <td><a href="{{route('Order.edit',['order_number'=>$order->order_number])}}" class="nav-link btn btn-dark">Check</a></td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                {{$orders->links()}}
                    </div>
                </div>
            </div>
     
@endsection