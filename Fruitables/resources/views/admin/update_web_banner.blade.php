@extends('admin.include.master_file')
@section('title')
Update Cards
@endsection
@section('body')

<div class="container p-4">
    <div class="col-sm-12 col-xl-12">
        @if (null !== session('success'))
        <div id="alertBox" class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
        @endif
        <div class="bg-secondary rounded h-100 p-4">
            <form action="{{route('Web.update',['id'=>$Banner[0]->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="position-relative mb-3">
                    <h3 class="mb-4 d-inline">Update Card</h3>
                    <a href="{{route('admin.index')}}" class="nav-item nav-link d-inline btn btn-dark position-absolute top-0 end-0">Back To Home</a>
                </div>

                <div class="form-floating mb-3" id="titlee">
                    <input type="text" name="BannerTit" value="{{$Banner[0]->Banner_Title}}" class="form-control" id="CardTitle" placeholder="Card Title">
                    <label for="CardTitle">Card Title</label>
                    @error('BannerTit')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3" id="Image_icon">
                    <input type="file" name="BannerImg" class="form-control form-control-lg bg-dark pt-3" id="CardIcon" aria-describedby="emailHelp">
                    <img id="OfferImg" class="" height="50px" width="50px" src="{{asset('storage/'.$Banner[0]->Banner_image)}}" alt="">
                    @error('BannerImg')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating" id="descriptu">
                    <textarea class="form-control" name="BannerDesc" placeholder="Card Description" id="CardDesc" style="height: 290px;">{{$Banner[0]->Banner_Desc}}</textarea>
                    @error('BannerDesc')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <button type="submit" class="nav-item nav-link mt-3 btn btn-dark">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    new FroalaEditor('#CardDesc');
});
</script>
