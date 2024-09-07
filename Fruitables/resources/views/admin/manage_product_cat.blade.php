
@extends('admin.include.master_file')
@section('title')
Home
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
                        <h3 class="mb-4 d-inline">Manage Product Category</h3>        
                <a  href="{{route('Product-cat.create')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Add Category</a>
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Category Detail</th> 
                                    <th scope="col">Action</th>                        
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($prodcat as $category )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->category_desc}}</td>
                                    <td> <img height="100px" width="100px" src="{{asset('storage/'.$category->category_image)}}" alt=""></td>
                                    <td><div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{route('Product-cat.show',['id'=>$category->id])}}" class="btn btn-warning">Update</a>
                                        <a href="{{route('Product-cat.destroy',['id'=>$category->id])}}" class="btn btn-danger">Delete</a>
                                      </div></td>
                                </tr> 
                                @endforeach
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
     
@endsection