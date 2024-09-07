@extends('user.include.master_file')
@section('title')
Refund Policy
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Refund Policy</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection
@section('body')
   <!-- Featurs Section Start -->
   <div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h1 class="display-5 mb-5 text-dark">Refund Policy</h1>
            <div class="row mb-5 mt-5">
                {!!$terms_conditions[2]->terms_conditions!!}
        </div>
 
        </div>
    
    </div>
</div>
<!-- Featurs Section End -->

@endsection
