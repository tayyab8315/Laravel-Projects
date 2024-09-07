@extends('admin.include.master_file')

@section('title', 'Product')

@section('body')
<div class="container p-4">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <form action="{{ route('Product.store')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="position-relative mb-3">
                    <h3 class="mb-4 d-inline">Add Product</h3>
                    <a href="{{ route('Product-cat.index') }}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0">Back</a>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="product_name" class="form-control" id="floatingInput" placeholder="Category Name">
                    <label for="floatingInput">Product Name</label>
                    @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="number" name="prod_price" min="1" class="form-control" id="floatingInput" placeholder="Category Name">
                    <label for="floatingInput">Product price</label>
                    @error('prod_price')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="prod_discount" min="1" class="form-control" id="floatingInput" placeholder="Category Name">
                    <label for="floatingInput">Discount</label>
                    @error('prod_discount')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <label for="formFileLg" class="form-label">Product Image</label>
                    <input type="file"  name="image"  class="form-control form-control-lg bg-dark" id="formFileLg" aria-describedby="emailHelp">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select border" name="main_cat" id="categorySelect" aria-label="Floating label select example">
                        <option selected class="">Product Category</option>
                        @foreach ($cat as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                    <label for="categorySelect">Product Category</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select border" name="subcategory" id="subcategorySelect" aria-label="Floating label select example">
                        <option selected class="">Select Subcategory</option>
                    </select>
                    <label for="subcategorySelect">Product Subcategory</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" name="Prod_Desc" placeholder="Category Description" id="floatingTextarea" style="height: 190px;"></textarea>
                    <label for="floatingTextarea">Product Description</label>
                    @error('Prod_Desc')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="nav-item nav-link mt-3 btn btn-dark">Add Product</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#categorySelect').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subcategorySelect').empty();
                        $('#subcategorySelect').append('<option selected="selected" value="">Select Subcategory</option>');
                        $.each(data, function(key, value) {
                            $('#subcategorySelect').append('<option value="'+ value.id +'">'+ value.sub_category_name +'</option>');
                        });
                    }
                });
            } else {
                $('#subcategorySelect').empty();
                $('#subcategorySelect').append('<option selected="selected" value="">Select Subcategory</option>');
            }
        });
    });
</script>
@endsection
