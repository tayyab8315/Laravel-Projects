
@extends('admin.include.master_file')
@section('title')
Prouct-Category
@endsection
@section('body')
<div class="container p-4">
     <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{route('Product-cat.update',['id'=>$prodCat->id])}}" enctype="multipart/form-data" method="post">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Update Product Category</h3>        
                                <a  href="{{route('Product-cat.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back</a>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="catName" value="{{$prodCat->category_name}}" class="form-control" id="floatingInput"
                                    placeholder="Category Name">
                                <label for="floatingInput">Category Name</label>
                                @error('catName')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <label for="formFileLg" class="form-label">Product Image</label>
                                <input type="file"  name="catImg"  class="form-control form-control-lg bg-dark" id="formFileLg" aria-describedby="emailHelp">
                               <img height="50px" width="50px" src="{{asset('storage/'.$prodCat->category_image)}}" alt="">
                                @error('catImg')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" value="{{$prodCat->category_desc}}" name="catDesc" placeholder="Category Description"
                                    id="floatingTextarea" style="height: 190px;"></textarea>
                                <label for="floatingTextarea">Category Description</label>
                                @error('catDesc')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <button type="submit" class="nav-item nav-link mt-3 btn btn-dark">Update Category</button>
                        </form>
                        </div>
                    </div>
                    </div>
@endsection