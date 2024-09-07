@extends('user.include.master_file')

@section('title')
Product Details
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Product Details</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('Shop.index')}}">Shop</a></li>
</ol>
@endsection
@section('body')
    
@php
           $avg_rating = round($product->avg_rating);
@endphp

        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="{{asset('storage/'.$product->image)}}" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3">{{$product->name}}</h4>
                                <p class="mb-3">Category: {{$product->Category->category_name}}</p>
                                <span class="fw-bold h5 mb-3 me-3">${{$product->price}}/kg</span>
                                 @if ($product->discount > 1)
                                <span class="fs-5 fw-bold mb-0 text-decoration-line-through text-danger">${{($product->discount/100 * $product->price)+$product->price }}/ kg</span> 
                                @endif
                                <div class="d-flex mb-4 mt-4">
                                @if ( $avg_rating==0)
                                  <h6 class="text-warning" >Not Yet Rated</h6>
                                @else
                                @for ( $i=0 ; $i < $avg_rating; $i++)
                                <i class="fa fa-star text-secondary"></i>
                               @endfor
                                @for ( $j=5 ; $j > $avg_rating; $j--)
                                <i class="fa fa-star"></i>
                                @endfor
                                @endif   
                                </div>
                                <p class="mb-4">{{$product->description}}</p>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="quantity-input" class="form-control form-control-sm text-center border-0" value="1">
                                    <input type="hidden" id="product-id"  value="{{$product->id}}">
                                    <div class="input-group-btn">
                                        <button id="increase" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a id="add-to-cart-btn" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary" prodid="{{$product->id}}">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                </a>
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. 
                                            Susp endisse ultricies nisi vel quam suscipit </p>
                                        <p>Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic 
                                            icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.</p>
                                        <div class="px-2">
                                           
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                     @foreach ($product->prodcomment as $comment )
                                     <div class="d-flex mb-2">
                                        <img src="{{asset('storage/'.$comment->commentuser->profile_picture)}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                        <p class="mb-2" style="font-size: 14px;">{{$comment->created_at}}</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>{{$comment->name}}</h5>
                                                <div class="d-flex mb-3 ms-5">
                                                    @for ( $i=0 ; $i < $comment->rating; $i++)
                                                    <i class="fa fa-star text-secondary"></i>
                                                    
                                                    @endfor
                                                    
                                                    @for ( $j=5 ; $j > $comment->rating; $j--)
                                                    <i class="fa fa-star"></i>
                                                    
                                                    @endfor

                                                </div>
                                            </div>
                                            <p class="text-dark">{{$comment->review}}</p>
                                        </div>
                                    </div>
                                     @endforeach
                                     
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>
                                                       
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                           
                            <div class="col-lg-12">
                                <h4 class="mb-3">Featured products</h4>
                               
@foreach ($featuredProducts as $feature )
<div class="d-flex align-items-center justify-content-start mb-1">
<div class="rounded me-4" style="width: 100px; height: 100px;">
<img src="{{ asset('storage/'.$feature->image)}}" class="img-fluid rounded" alt="">
</div>
<div>
<h6 class="mb-2">{{ $feature->name}}</h6>

<div class="d-flex mb-2">
    {{-- {{ $feature->prodcomment}} --}}
    @if($feature->prodcomment->isEmpty())
    Not Yet Rated
@else
    @php
$rating = round($feature->prodcomment->avg('rating'));
    @endphp

    @for ($i = 0; $i <  $rating; $i++)
        <i class="fa fa-star text-secondary"></i>
    @endfor
    @for ($i = 5; $i > $rating; $i--)
        <i class="fa fa-star"></i>
    @endfor
@endif


  
</div>
<div class="d-flex mb-2">
    <h5 class="fw-bold me-2">{{ $feature->price}} $</h5>
    @if($feature->discount>1)
            <h5 class="text-danger text-decoration-line-through">{{ ($feature->discount/100*$feature->price)+$feature->price}} $</h5>
            @endif
</div>
</div>
</div>
@endforeach
                             

                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/'.$Cards[12]->icon) }}" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">{!!$Cards[12]->Description!!}</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="container">
                    <form id="commentForm" action="{{ route('save.comment') }}" method="POST">
                        @csrf
                        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="border-bottom rounded">
                                    <input type="text" class="form-control border-0 me-4" placeholder="Your Name *" name="name" required>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="email" class="form-control border-0" placeholder="Your Email *" name="email" required>
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="border-bottom rounded my-4">
                                    <textarea name="review" id="review" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between py-3 mb-5">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-3">Please rate:</p>
                                        <div class="d-flex align-items-center star-rating" style="font-size: 12px;">
                                            <i class="fa fa-star fa-2x" data-rating="1"></i>
                                            <i class="fa fa-star fa-2x" data-rating="2"></i> 
                                            <i class="fa fa-star fa-2x" data-rating="3"></i>
                                            <i class="fa fa-star fa-2x" data-rating="4"></i>
                                            <i class="fa fa-star fa-2x" data-rating="5"></i>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3">Post Comment</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="rating" id="rating">
                        <input type="hidden" name="prodct_id" value="{{$product->id}}" >
                        <input type="hidden" name="user_id" value="10" >
                    </form>
                </div>

           
@if(count($related_products) > 0)
<h1 class="fw-bold mb-0">Related products</h1>
<div class="vesitable">
    <div class="owl-carousel vegetable-carousel justify-content-center">
@foreach ($related_products as $related_prod )
<div class="border border-primary rounded position-relative vesitable-item">
    <div class="vesitable-img">
        <img src="{{ asset('storage/'.$related_prod->image) }}" class="img-fluid w-100 rounded-top" alt="">
    </div>
    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{$related_prod->Category->category_name}}</div>
    <a href="{{route('Shop.edit',['id'=>$related_prod->id])}}" class="text-dark">
    <div class="p-4 pb-0 rounded-bottom">
        <h4>{{$related_prod->name}}</h4>
        <p>{{ Str::words($related_prod->description,17, '...') }}</p>
        <div class="d-flex justify-content-between flex-lg-wrap">
            <h5 class="text-dark fs-5 fw-bold">${{$related_prod->price}} / kg</h5>
            @if($related_prod->discount>1)
            <h5 class="text-danger text-decoration-line-through">{{ ($related_prod->discount/100*$related_prod->price)+$related_prod->price}} $</h5>
            @endif
            <a class="btn  border border-secondary rounded-pill px-3  text-primary CartBtn mb-1 mt-1" prodid="{{$related_prod->id}}"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
            <a  class="btn  border border-secondary rounded-pill px-3  text-primary mb-3" id="wishBtn" prodid="{{$related_prod->id}}"><i class="fa fa-heart me-2 text-primary"></i> Add to Wishlist</a>
             </div>
    </div>
    </a>
</div>
@endforeach

</div>
</div>

@endif


                  

            </div>
        </div>
      
        <!-- Ensure jQuery is loaded before your script -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-to-cart-btn').click(function(e) {
            e.preventDefault();

            var quantity = $('#quantity-input').val();
            var productId = {{ $product->id }};
            // var productId = $('#product-id').val(); // Corrected variable name to match HTML id

            $.ajax({
                url: '{{ route("Cart.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity,
                    user_id: productId // Corrected variable name to match backend expectation
                },
                success: function(response) {
                    alert('Product added to cart successfully!');
                    // Optionally update cart UI or show success message
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
</script> --}}

        @endsection