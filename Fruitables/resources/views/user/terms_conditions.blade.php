



@extends('user.include.master_file')
@section('title')
Terms and Conditions
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Terms and Conditions</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection
@section('body')
   <!-- Featurs Section Start -->
   <div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h1 class="display-5 mb-5 text-dark">Terms and Conditions</h1>
            <div class="row mb-5 mt-5">
{!!$terms_conditions[0]->terms_conditions!!}
        </div>
 
        </div>
    
    </div>
</div>
<!-- Featurs Section End -->

@endsection
