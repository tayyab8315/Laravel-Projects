<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
   
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href=" {{asset('css/style.css')}}" rel="stylesheet">
    <!-- You can include Bootstrap here if needed -->
</head>
<style>
    
</style>
<body>
    <div id="spinner" class="show"></div>
    
    <div class="containerrr mx-auto d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-form bg-white p-4 rounded shadow ">
            <h2 class="text-center mb-4">Register</h2>

            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

  
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your email">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="image">image</label>
                    <input type="file" class="form-control" name="image" id="image" >
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Enter your password">
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <p class="text-start mt-3 ">
                    Already Have Account?
                    <a href="{{route('user.index')}}" class="btn-link text-primary">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
    
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>