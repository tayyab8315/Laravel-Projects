
@extends('admin.include.master_file')
@section('title')
Add Faqs
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
                       
                            <form action="{{route('Faqs.store')}}" id="form"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Add Faqs</h3>        
                                <a  href="{{route('admin.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back To Home</a>
                            </div>
                            <div id="teams">
                            <div class="form-floating mb-3" id="destination">
                                <input type="text" name="destination" value="" class="form-control" id="Carddesti"
                                    placeholder="Member Destination">
                                <label for="destination">Question</label>
                                @error('destination')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                        </div>
                            <div class="form-floating" id="descriptu">
                                <textarea class="form-control" value="" name="CardDesc" placeholder="Category Description"
                                    id="CardDesc" style="height: 290px;"></textarea>
                                @error('CardDesc')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <button type="submit" class="nav-item nav-link mt-3 btn btn-dark">Add</button>
                        </form>
                        </div>
                    </div>
                    </div>




                    
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
           document.addEventListener('DOMContentLoaded', function() {

     editor =   new FroalaEditor('textarea');


                  });
   
</script>