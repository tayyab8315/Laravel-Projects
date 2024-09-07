
@extends('admin.include.master_file')
@section('title')
Prodcuts
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
                        <h3 class="mb-4 d-inline">Manage Products</h3>        
                <a  href="{{route('Product.create')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Add Product</a>
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col"> Feature Product</th>
                                    <th scope="col">Sale</th>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Action</th>                        
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($prod as $poduct )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{$poduct->name}}</td>
                                    {{-- <td>{{$poduct->feature}}</td> --}}
                                    @if ($poduct->feature =='no')
                                    <td><a href="{{route('Product.feature',['id'=>$poduct->id])}}" class=" btn btn-success">Add</a></td>
                                    @else
                                    <td><a href="{{route('Product.feature',['id'=>$poduct->id])}}" class=" btn btn-danger">Remove</a></td>
                                    @endif
                                    @if ($poduct->sale =='no')
                                    <td><a href="{{route('Product.sale',['id'=>$poduct->id])}}" class=" btn btn-success">Add</a></td>
                                    @else
                                    <td><a href="{{route('Product.sale',['id'=>$poduct->id])}}" class=" btn btn-danger">Remove</a></td>
                                    @endif
                                    <td><a href="{{route('Product.edit',['id'=>$poduct->id])}}" class=" btn btn-success">Add</a></td>
                                    <td><a href="{{route('Product.edit',['id'=>$poduct->id])}}" class="nav-link btn btn-dark">Show</a></td>
                                    <td><div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{route('Product.show',['id'=>$poduct->id])}}" class="btn btn-warning">Update</a>
                                        <a href="{{route('Product.destroy',['id'=>$poduct->id])}}" class="btn btn-danger">Delete</a>
                                      </div></td>
                                </tr> 
                                @endforeach
                              
                           
                            </tbody>
                        </table>
                {{$prod->links()}}
                    </div>
                </div>
            </div>
     
@endsection