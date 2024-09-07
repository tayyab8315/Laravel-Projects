
@extends('admin.include.master_file')
@section('title')
Contact Us
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
                        <h3 class="mb-4 d-inline">Manage Contact Us Messages</h3>        
                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Status</th> 
                                    <th scope="col">Action</th>                        
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($contacts as $contact )
                                <tr>
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->message}}</td>
                                 
                                      <td>
                                        @if($contact->status == 'read')
                                        <a href="{{route('contacts.edit',['id'=>$contact->id])}}" class="btn btn-success">Read</a>
                                        @else
                                        <a href="{{route('contacts.edit',['id'=>$contact->id])}}" class="btn btn-danger">Un-Read</a>
                                        @endif
                                    </td>
                                    <td><div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{route('contacts.destroy',['id'=>$contact->id])}}" class="btn btn-danger">Delete</a>
                                      </div></td>
                                </tr> 
                                @endforeach
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
     
@endsection