
@extends('admin.include.master_file')
@section('title')
Update About Us
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
                       
                            <form action="{{route('pages.about_us_modified')}}" id="form"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Update About Us</h3>        
                                <a  href="{{route('admin.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back To Home</a>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select  pt-4 " name="row" id="RowSelect" aria-label="Floating label select example">
                                    <option selected value="none">Select Row</option>
                                    <option value="1">About Us</option>
                                    <option  value="2">Team Member 1</option>
                                    <option  value="3">Team Member 2</option>
                                    <option  value="4">Team Member 3</option>
                                    <option  value="5">Team Member 4</option>
                            
                                </select>
                                <label for="categorySelect" >Card Row</label>
                            </div>
                            <div id="teams">
                            <div class="form-floating mb-3" id="titlee">
                                <input type="text" name="CardTit" value="" class="form-control" id="CardTitle"
                                    placeholder="Member Name">
                                <label for="CardTitle">Member Name</label>
                                @error('CardTit')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating mb-3" id="destination">
                                <input type="text" name="destination" value="" class="form-control" id="Carddesti"
                                    placeholder="Member Destination">
                                <label for="destination">Member Destination</label>
                                @error('destination')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating mb-3 " id="Image_icon">
                                <input type="file"  name="CardIcon"   class="form-control form-control-lg bg-dark pt-3" id="CardIcon" aria-describedby="emailHelp">
                                <img id="OfferImg" class="" height="50px" width="50px" src="" alt="">
                                @error('CardIcon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                            <div class="form-floating" id="descriptu">
                                <textarea class="form-control" value="" name="CardDesc" placeholder="Category Description"
                                    id="CardDesc" style="height: 290px;"></textarea>
                                {{-- <label for="CardDesc">Card Description</label> --}}
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

        // Initialize CKEditor
        // CKEDITOR.replace('CardDesc');
     editor =   new FroalaEditor('textarea');
   var row = document.getElementById('RowSelect');
   var teams = document.getElementById('teams');
   var CardDesc = document.getElementById('descriptu');

   row.addEventListener('change', function() {

           let rowNumber = row.value; 
console.log(rowNumber);
           if(rowNumber==1){
            CardDesc.classList.remove('d-none');
            teams.classList.add('d-none');
           }else{
            CardDesc.classList.add('d-none');
            teams.classList.remove('d-none');
           }

           getdata(rowNumber);
});

    });

   function getdata(rowNumber){
       // Send AJAX request to update session in Laravel
       $.ajax({
                      url: `http://127.0.0.1:8000/pages/teamdetails`,
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
                        let CardTitle = document.querySelector('#CardTitle');
                        let Carddesti = document.querySelector('#Carddesti');
                        let OfferImg = document.querySelector('#OfferImg');
                        let CardDesc = document.querySelector('#CardDesc');
                        // let formAction =`http://127.0.0.1:8000/pages/${response.id}/update`;
                        // let form = document.querySelector('#form').setAttribute('action', formAction);

                        CardTitle.value = response.name;
                        Carddesti.value = response.destination;
                        editor.html.set(response.page_description); 
                        OfferImg.src = `../storage/${response.image}`;
                    },
                      error: function(xhr, status, error) {
                          console.error(error);
                          alert('Something went wrong. Please try again.');
                      }
                  });
   }
</script>