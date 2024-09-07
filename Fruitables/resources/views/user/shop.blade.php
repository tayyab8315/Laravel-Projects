
@extends('user.include.master_file')
@section('title')
Shop
@endsection
@section('banner')
<h1 class="text-center text-white display-6">Shop</h1>
<ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
</ol>
@endsection
@section('body')
     
        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4 text-center">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" value="" class="form-control p-3" id="ShopSearch" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="Organic" class="Additional">Organic</option>
                                        <option value="Fresh" class="Additional">Fresh</option>
                                        <option value="Sales" class="Additional">Sales</option>
                                        <option value="Discount" class="Additional">Discount</option>
                                        <option value="Feature" class="Additional">Feature</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                @foreach ($Category as $cat )
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{route('Shop.show',['id'=>$cat->id])}}"><i class="fas fa-apple-alt me-2"></i>{{$cat->category_name}}</a>
                                                        <span>({{$categoryCounts[$cat->id] ?? 0 }})</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                               
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="mb-2">Price</h4>
                                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="44" value="0" >
                                            <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Additional</h4>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 Additional" id="Categories-1" name="Categories-1" value="Organic">
                                                <label for="Categories-1"> Organic</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 Additional" id="Categories-2" name="Categories-1" value="Fresh">
                                                <label for="Categories-2"> Fresh</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 Additional" id="Categories-3" name="Categories-1" value="Sales">
                                                <label for="Categories-3"> Sales</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 Additional" id="Categories-4" name="Categories-1" value="Discount">
                                                <label for="Categories-4"> Discount</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 Additional" id="Categories-4" name="Categories-1" value="Feature">
                                                <label for="Categories-4">Feature Products</label>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-lg-12">
                                        <h4 class="mb-3">Featured products</h4>
                                       
@foreach ($featuredProducts as $feature )
<div class="d-flex align-items-center justify-content-start mb-1">
    <div class="rounded me-4" style="width: 100px; height: 100px;">
        <img src="{{asset('storage/'.$feature->image)}}" class="img-fluid rounded" alt="">
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
                                            <img src="{{asset('storage/'.$Cards[12]->icon)}}" class="img-fluid w-100 rounded" alt="">
                                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <h3 class="text-secondary fw-bold">{!!$Cards[12]->Description!!}</h3>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center" id="shoprow">
                                    @foreach ($products as $product)
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                           
                                            <div  class="rounded position-relative fruite-item">
                                            {{-- <div > --}}
                                                <div class="fruite-img">
                                                    <img src="{{asset('storage/'.$product->image)}}" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->Category->category_name}}</div>
                                                <a href="{{route('Shop.edit',['id'=>$product->id])}}" class="text-dark">
                                                <div class="p-4 border border-secondary border-top-0  rounded-bottom cardbody">
                                                    <h4>{{$product->name}}</h4>
                                                    <p>{{Str::words($product->description,17, '...') }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <span class="text-dark fs-5 fw-bold mb-0 me-3">${{$product->price}}/ kg</span> 
                                                        @if ($product->discount > 1)
                                                        <span class="fs-5 fw-bold mb-0 text-decoration-line-through text-danger">${{($product->discount/100 * $product->price)+$product->price }}/ kg</span> 
                                                        @endif
                                                        
                                                        <a class="btn  border border-secondary rounded-pill px-3  text-primary CartBtn mb-1 mt-1" prodid="{{$product->id}}"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                        <a  class="btn  border border-secondary rounded-pill px-3  text-primary " id="wishBtn" prodid="{{$product->id}}"><i class="fa fa-heart me-2 text-primary"></i> Add to Wishlist</a>
                                                    </div>
                                                </div>
                                            </a>
                                            </div>
                                        
                                        </div> 
                                    
                                        
                                    @endforeach
                                   
                                    {{ $products->links('vendor.pagination.userPaginate') }}
                                </div>
                                <div class="col-12 dynamic">
                                    {{-- <div class="d-none d-flex justify-content-end  mt-3" id="shopnumber">
                                        kiss
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->

        @endsection
       