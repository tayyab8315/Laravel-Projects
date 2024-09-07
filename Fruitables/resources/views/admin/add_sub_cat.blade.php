
@extends('admin.include.master_file')
@section('title')
Prouct-Category
@endsection
@section('body')
<div class="container p-4">
     <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <form action="{{route('Product-Subcat.store')}}" method="post">
                                @csrf
                            <div class="position-relative mb-3">
                                <h3 class="mb-4 d-inline">Add Product Sub Category</h3>        
                                <a  href="{{route('Product-Subcat.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0" >Back</a>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="catName" class="form-control" id="floatingInput"
                                    placeholder="Category Name">
                                <label for="floatingInput">Sub Category Name</label>
                                @error('catName')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>

                            <div class="form-floating mb-3">
                            <select class="form-select border" name="main_cat" id="floatingSelect" aria-label="Floating label select example">
                                <option selected class=" ">Product Category</option>
                
                                @foreach ($prodcat as $cat)
                                <option value="{{$cat->id}}">{{$cat->category_name}}</option> 
                                @endforeach
                            </select>
                        </div>


                            <div class="form-floating">
                                <textarea class="form-control" name="catDesc" placeholder="Category Description"
                                    id="floatingTextarea" style="height: 190px;"></textarea>
                                <label for="floatingTextarea">Sub Category Description</label>
                                @error('catDesc')
                                <div class="text-danger">{{$message}}</div> 
                             @enderror
                            </div>
                            <button type="submit" class="nav-item nav-link mt-3 btn btn-dark">Add Sub Category</button>
                        </form>
                        </div>
                    </div>
                    </div>
@endsection