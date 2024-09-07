
@extends('admin.include.master_file')
@section('title')
Update Cards
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
                       
                            <form action="{{route('updateCard')}}"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Update Card</h3>        
                                <a  href="{{route('admin.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back To Home</a>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select  pt-4 " name="row" id="RowSelect" aria-label="Floating label select example">
                                    <option selected value="none">Select Row</option>
                                    <option value="1">1st Row Cards</option>
                                    <option  value="2">2nd Row Cards</option>
                                    <option  value="3">Offers Cards</option>
                                    <option  value="4">Single Card</option>
                                    <option  value="5">Shop Banner</option>
                                    <option  value="6">Page Header</option>
                                </select>
                                <label for="categorySelect" >Card Row</label>
                            </div>
            
                            <div class="form-floating mb-3">
                                <select class="form-select pt-4 " name="CardNumber" id="CardSelect" aria-label="Floating label select example">
                                    <option selected value="none">Select Card</option>
                    
                                </select>
                                <label for="subcategorySelect">Card Number</label>
                            </div>


                            <div class="form-floating mb-3" id="titlee">
                                <input type="text" name="CardTit" value="" class="form-control" id="CardTitle"
                                    placeholder="Category Name">
                                <label for="CardTitle">Card Title</label>
                                @error('CardTit')
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
        var card = document.getElementById('CardSelect');
   var row = document.getElementById('RowSelect');
   var CardTitle = document.getElementById('CardTitle');
   var CardIcon = document.getElementById('CardIcon');
   var CardDesc = document.getElementById('CardDesc');
   
   let rowNumber = row.value;
   let cardNumber=card.value;
   
   row.addEventListener('change', function() {

    cardshtml=card.innerHTML;

           let rowNumber = row.value;
if(rowNumber == 1 || rowNumber == 2 ){
    card.innerHTML='';
    card.innerHTML =`<option selected value="none">Select Card</option>
                                    <option  value="1" >1st Card</option>
                                    <option  value="2" >2nd Card</option>
                                    <option  value="3">3rd Card</option>
                                    <option  value="4">4th Card</option>`;
                                    document.querySelector('#titlee').classList.remove('d-none');
   }else if(rowNumber == 3){
        
                card.innerHTML='';
                card.innerHTML=`   <option selected value="none">Select Card</option>
                                    <option  value="1" >1st Card</option>
                                    <option  value="2" >2nd Card</option>
                                    <option  value="3">3rd Card</option>
                                `;
                                document.querySelector('#titlee').classList.remove('d-none');

           }else if(rowNumber == 4 ){
        
                card.innerHTML='';
                card.innerHTML=`   <option selected value="none">Select Card</option>
                                    <option  value="1" >1st Card</option>
                            `; 
                            document.querySelector('#titlee').classList.remove('d-none');


                            
           }else if(rowNumber == 5 ){
        
        card.innerHTML='';
        card.innerHTML=`   <option selected value="none">Select Card</option>
                            <option  value="1" >1st Card</option>
                    `; 

document.querySelector('#titlee').classList.add('d-none');
                    
   }else if(rowNumber == 6 ){
        
        card.innerHTML='';
        card.innerHTML=`   <option selected value="none">Select Card</option>
                            <option  value="1" >1st Card</option>
                    `; 

document.querySelector('#titlee').classList.add('d-none');
document.querySelector('#descriptu').classList.add('d-none');

                    
   }
});

   card.addEventListener('change', function() {
           let rowNumber = row.value;
           let cardNumber = card.value;
        //    console.log(rowNumber+" Card"+cardNumber);
           getdata(rowNumber, cardNumber);
           
       });
    });
   function getdata(rowNumber,cardNumber){
       // Send AJAX request to update session in Laravel
       $.ajax({
                      url: `http://127.0.0.1:8000/Web/store`,
                      method: 'POST',
                      data: {
                        rowNumber: rowNumber,
                        cardNumber: cardNumber, // Corrected variable name to match backend expectation
                      },
                      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
    },
                      success: function(response) {
                        console.clear();
                        console.log(response);
                        CardTitle.value=response.title;
                       document.getElementById('OfferImg').src =`../storage/${response.icon}`;
                       editor.html.set(response.Description); // Using FroalaEditor instance method to set data
                      },
                      error: function(xhr, status, error) {
                          console.error(error);
                          alert('Something went wrong. Please try again.');
                      }
                  });
   }
</script>