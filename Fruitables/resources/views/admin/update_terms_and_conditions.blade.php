
@extends('admin.include.master_file')
@section('title')
Terms and Conditions
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
                       
                            <form action="{{route('pages.terms_modified')}}" id="form"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Update Terms And Conditions</h3>        
                                <a  href="{{route('admin.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back To Home</a>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select  pt-4 " name="row" id="RowSelect" aria-label="Floating label select example">
                                    <option selected value="none">Select Policy</option>
                                    <option value="1">Website Use Policy</option>
                                    <option  value="2">Privacy Policy</option>
                                    <option  value="3">Refund Policy</option>
                                </select>
                                <label for="categorySelect" >Card Row</label>
                            </div>
                            <div class="form-floating" id="descriptu">
                                <textarea class="form-control" value="" rows="22" name="CardDesc" placeholder="Category Description"
                                    id="CardDesc">
                                </textarea>

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
               document.addEventListener('DOMContentLoaded', function() {
         editor =   new FroalaEditor('textarea');
let row = document.querySelector('#RowSelect');
console.log(row);
row.addEventListener('change', function() {
let rowNumber = row.value;
console.log(rowNumber);
if(rowNumber!='none'){
    getdata(rowNumber);

}

});


});
function getdata(rowNumber){
   // Send AJAX request to update session in Laravel
   $.ajax({
                  url: `http://127.0.0.1:8000/terms_conditions`,
                  method: 'POST',
                  data: {
                    rowNumber: rowNumber,
                  },
                  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
},
                  success: function(response) {
                    console.clear();
                    console.log(response);
                   editor.html.set(response.terms_conditions); // Using FroalaEditor instance method to set data
                  },
                  error: function(xhr, status, error) {
                      console.error(error);
                      alert('Something went wrong. Please try again.');
                  }
              });



               };
</script>