@extends('user.include.master_file')
@section('title')
About Us
@endsection
@section('banner')
<h1 class="text-center text-white display-6">About Us</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection
@section('body')
   <!-- Featurs Section Start -->
   <div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">About Us</h4>
            <div class="row mb-5 mt-5">
       {!!$about[0]->page_description!!}  
        </div>
            <h1 class="display-5 mb-5 text-dark">Our Team</h1>
        </div>
        <div class="row g-4">
    
            @foreach (@$about as $about_us )
                @if($about_us->id != 1)
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class=" w-75 rounded-circle  mb-3 p-1 mx-auto">
                           <img class="rounded-circle border border-5 border-secondary" height="150px" width="150px" src="{{asset('storage/'.$about_us->image)}}" alt="">
                        </div>
                        <div class="featurs-content text-center">
                            <h5>{{$about_us->name}}</h5>
                            <p class="mb-0">{{$about_us->destination}}</p>
                        </div>
                    </div>
                </div>

                @endif
            @endforeach
        </div>
    
    </div>
</div>
<!-- Featurs Section End -->

@endsection
       