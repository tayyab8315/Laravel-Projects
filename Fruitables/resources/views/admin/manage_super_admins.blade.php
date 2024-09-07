
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
                   
                    <div class="position-relative mb-3  ">
         <div class="row">
            <div class="col-6 text-start">
                <h3 class="mb-4 d-inline">Super Admins</h3> 
            </div>
            <div class="col-6 text-end">
                <a href="" class="btn btn-primary mx-auto ">Add New Super Admin</a>
            </div>
         </div>
 

                    </div>
                    <div class="table-responsive">
                        <table  class="table text-center align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Admin Image</th>
                                    <th scope="col">Admin Name</th>
                                    <th scope="col">Admin Mail</th>  
                                    <th scope="col">Make Admin</th>       
                                    <th scope="col">Delete</th>                    
                                </tr>
                            </thead>
                            <tbody>
@foreach ($admins as $admin)
<tr>
    <td><input class="form-check-input" type="checkbox"></td>
    <td><img height="70px" width="70px" src="{{asset('storage/'.$admin->profile_picture)}}" alt=""></td>
    <td>{{$admin->name}}</td>
    <td>{{$admin->email}}</td>
    <td>  @if ($admin->role == 'super_admin')
        <a class="btn btn-light" href="{{route('admin.make',['id'=>$admin->id])}}">Make</a>
        @endif    
     </td>
<td>
    <a class="btn btn-primary" href="{{route('admin.destroy',['id'=>$admin->id])}}">Delete</a>
</td>
</tr>
@endforeach
                           
                            
                            </tbody>
                        </table>
                {{-- {{$orders->links()}} --}}
                    </div>
                </div>
            </div>
     
@endsection