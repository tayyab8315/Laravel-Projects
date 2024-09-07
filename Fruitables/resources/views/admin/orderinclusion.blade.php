
@extends('admin.include.master_file')
@section('title')
Order_inclusion
@endsection
@section('body')


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="position-relative mb-3 text-start ">
                        <h3 class="mb-4 d-inline">Order Inclusion</h3>        
                <a  href="{{route('Order.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back To Orders</a>
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Order Number</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Product Quantity</th>
                               
                            </thead>
                            <tbody>

                                @foreach ($prod_items as $poduct )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td> <img height="100px" width="100px" src="{{asset('storage/'.$poduct->include_products->image)}}" alt=""></td>
                                    <td>{{$poduct->order_number}}</td>
                                    <td>{{$poduct->include_products->name}}</td>
                                    <td>{{$poduct->include_products->price}}</td>
                                    <td>{{$poduct->product_quantity}}</td>    
                                </tr> 
                                @endforeach
                              
                           
                            </tbody>
                        </table>
                {{$prod_items->links()}}
                    </div>
                </div>
            </div>
     
@endsection