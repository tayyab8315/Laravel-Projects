
@extends('user.include.master_file')
@section('title')
Testimonial
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Testimonial</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
 
</ol>
@endsection
@section('body')


  <!-- Tastimonial Start -->
  <div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Our Testimonials</h4>
            <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
           
@foreach ($Testimonials as $testim)
<div class="testimonial-item img-border-radius bg-light rounded p-4">
<div class="position-relative">
<i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
<div class="mb-4 pb-4 border-bottom border-secondary">
    <p class="mb-0">{{$testim->review}}</p>
</div>
<div class="d-flex align-items-center flex-nowrap">
    <div class="bg-secondary rounded">
        <img src="storage/images/Product/avatar.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
    </div>
    <div class="ms-4 d-block">
        <h4 class="text-dark">{{$testim->name}}</h4>
        <br>
        <div class="d-flex pe-5">
            @for ($i=0.00; $i < $testim->rating; $i++)
            <i class="fas fa-star text-primary"></i>   
            @endfor
            @for ($i=5.00; $i > $testim->rating; $i--)
            <i class="fas fa-star"></i>  
            @endfor
 
          
        </div>
    </div>
</div>
</div>
</div>
@endforeach

        </div>
    </div>
</div>
<!-- Tastimonial End -->
@endsection