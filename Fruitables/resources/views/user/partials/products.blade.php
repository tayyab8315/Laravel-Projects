@foreach($products as $product)
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="rounded position-relative fruite-item">
            <div class="fruite-img">
                <img src="{{ asset('img/' . $product->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $product->name }}">
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{ $product->category->category_name }}</div>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                <h4>{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
                <div class="d-flex justify-content-between flex-lg-wrap">
                    <p class="text-dark fs-5 fw-bold mb-0">${{ $product->price }} / kg</p>
                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                </div>
            </div>
        </div>
    </div>
@endforeach

