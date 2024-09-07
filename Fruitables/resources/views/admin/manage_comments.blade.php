
@extends('admin.include.master_file')
@section('title')
Faqs
@endsection
@section('body')


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    @if (null !== session('deleted'))
                    <div id="alertBox" class="alert alert-danger" role="alert">
                        {{session('deleted')}}
                      </div>
                    @endif 
                    <div class="position-relative mb-3 text-start ">
                        <h3 class="mb-4 d-inline">Manage Reviews</h3>        
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">User</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Review</th>
                                    <th scope="col">Status</th> 
                                    <th scope="col">Action</th>                        
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($Comments as $Comment )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{$Comment->name}}</td>
                                    <td>{{$Comment->commentprod->name}}</td>
                                    <td>{{$Comment->rating}}</td>
                                    <td>{{$Comment->review}}</td>
                                    <td><div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{route('Review.destroy',['id'=>$Comment->id])}}" class="btn btn-danger">Delete</a>
                                      </div></td>
                                      <td>
                                        @if($Comment->status == 'hide')
                                        <a href="{{route('Review.edit',['id'=>$Comment->id])}}" class="btn btn-success">Show</a>
                                        @else
                                        <a href="{{route('Review.edit',['id'=>$Comment->id])}}" class="btn btn-danger">Hide</a>
                                        @endif
                                    </td>
                                </tr> 
                                @endforeach
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
     
@endsection