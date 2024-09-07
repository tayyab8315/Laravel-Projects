
<head>
    <meta charset="utf-8">
    <title>Frutibels Admin Signup </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    
    <!-- Froala Text Editor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('admin-lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin-lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('admin-css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('admin-css/style.css')}}" rel="stylesheet">
    <style>input[type="file"]::-webkit-file-upload-button {
        visibility: hidden;
    }</style>
</head>

<body>

  



<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sign Up Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 ">
                <div class="bg-secondary rounded p-4 p-sm-5">
             
                    <div class="d-flex align-items-center justify-content-between  mb-4">
                        <a href="index.html" class="">
                            <h3 class="text-primary">Admin</h3>
                        </a>
                        <h3>Sign Up</h3>
                    </div>
                    <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Name</label>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="email"  name="email" class="form-control" id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Email</label>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Password</label>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" class="form-control" id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Confirm Password</label>
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <input type="file" name="image" class="form-control bg-dark" id="floatingText" placeholder="jhondoe">
                                <label for="floatingText">Profile Picture</label>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                    
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                  </form>
                    <p class="text-center mb-0">Already have an Account? <a href="{{route('admin.signin')}}">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up End -->
</div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('admin-lib/chart/chart.min.js')}}"></script>
    <script src="{{asset('admin-lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('admin-lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('admin-lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin-lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('admin-lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('admin-lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('admin-js/main.js')}}"></script>

        <!-- Froala Text Editor JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
</body>

</html>










