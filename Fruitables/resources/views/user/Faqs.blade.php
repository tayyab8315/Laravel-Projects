@extends('user.include.master_file')
@section('title')
Faqs
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Faqs</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>

</ol>
@endsection
@section('body')
   <!-- Featurs Section Start -->
   <div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h1 class="display-5 mb-5 text-dark">Frequently Asked Questions</h1>
            <div class="row mb-5 mt-5">
                <div class="accordion accordion-flush" id="accordionFlushExample">
          @foreach ($faqs as $faq)
          <div class="accordion-item mb-3 border-0 ">
            <h2 class="accordion-header" id="flush-heading{{$faq->id}}">
              <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$faq->id}}" aria-expanded="false" aria-controls="flush-collapse{{$faq->id}}">
                {{$faq->question}}
              </button>
            </h2>
            <div id="flush-collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$faq->id}}" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">{!!$faq->answer!!}</div>
            </div>
          </div>         
          @endforeach
        </div> 
        </div>
 
        </div>
    
    </div>
</div>
<!-- Featurs Section End -->

@endsection
