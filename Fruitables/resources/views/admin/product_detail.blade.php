@extends('admin.include.master_file')
@section('title')
Product Detail
@endsection
@section('body')

<div class="container-fluid pt-4 px-4">
    <div class="row">
<div class="col-12 text-end mb-4"><a  href="{{route('Product.index')}}" class=" bg-secondary px-4 py-2 rounded " >Back</a></div>
        <div class="col-6">
            <div class="bg-secondary text-center rounded p-4">

                <div class="" >
              
                    <img src="{{asset('storage/'.$prodCat->image)}}" class="h img-fluid" alt="...">

                    
                  </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-secondary text-center rounded p-4">

                <div class="" >
                    <div class="card-body bg-tranparent">
                        <h1 class="card-title">{{$prodCat->name}}</h1>
                        <br>
                        <br>
                        <div class="text-start fs-4 text-white">Price: {{$prodCat->price}} / KG</div>
                        <div class="text-start fs-4 text-white">Discount: {{$prodCat->discount}} %</div>
                        <div class="text-start fs-4 text-white">Category: {{$prodCat->Category->category_name}}</div>
                        <div class="text-start fs-4 text-white">SubCategory: {{$prodCat->subcategory->sub_category_name}}</div>
                        <br>
                        <br>
                      <p class="card-text text-white">{{$prodCat->description}}</p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@endsection
