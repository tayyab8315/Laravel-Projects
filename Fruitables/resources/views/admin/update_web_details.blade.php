
@extends('admin.include.master_file')
@section('title')
Update Website Details
@endsection
@section('body')


<div class="container p-4">
     <div class="col-sm-12 col-xl-12">
        @if (null !== session('success'))
        <div id="alertBox" class="alert alert-success" role="alert">
            {{session('success')}}
          </div>
        @endif
                        <div class="bg-secondary rounded h-100 p-4">
                       
                            <form action="{{route('Web.Info_Update',['id'=>$Website_details[0]->id])}}"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Update Website Details</h3>        
                                <a  href="{{route('admin.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back To Home</a>
                            </div>
                            <div class="form-floating mb-3" id="titlee">
                                <input type="text" name="Name" value="{{$Website_details[0]->name}}" class="form-control" id="Name"
                                    placeholder="Category Name">
                                <label for="Name">Website Name</label>
                                @error('Name')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="webemail" value="{{$Website_details[0]->email}}" class="form-control" id="webemail"
                                    placeholder="Category Name">
                                <label for="webemail">Website email</label>
                                @error('webemail')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="phone" value="{{$Website_details[0]->phone}}" class="form-control" id="phone"
                                    placeholder="Category Name">
                                <label for="phone">Website Phone Number</label>
                                @error('phone')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating mb-3" >
                                <input type="text" name="Address" value="{{$Website_details[0]->address}}" class="form-control" id="Address"
                                    placeholder="Category Name">
                                <label for="Address">Website Address</label>
                                @error('Address')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating" id="descriptu">
                                <textarea class="form-control" value="" name="CardDesc" placeholder="Category Description"
                                    id="CardDesc" style="height: 390px;">{{$Website_details[0]->additional_info}}</textarea>
                                @error('CardDesc')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <button type="submit" class="nav-item nav-link mt-3 btn btn-dark">Update</button>
                        </form>
                        </div>
                    </div>
                    </div>
    
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    new FroalaEditor('#CardDesc');
});

</script>