<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables -  @yield('title','NO Value')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <!-- Froala Text Editor CSS -->
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
    </head>

    <body>
        @php
        use App\Models\web_detail;
             $Website_details = web_detail::get();
        @endphp

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="{{route('pages.index')}}" class="text-white">{{$Website_details[0]->address}}</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="mailto:{{$Website_details[0]->email}}" class="text-white">{{$Website_details[0]->email}}</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="{{route('display_privacy')}}" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="{{route('display_terms')}}" class="text-white"><small class="text-white mx-2">Terms and Conditions</small>/</a>
                        <a href="{{route('display_refund')}}" class="text-white"><small class="text-white ms-2">Refund Policy</small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{route('index')}}" class="navbar-brand"><h1 class="text-primary display-6">{{$Website_details[0]->name}}</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{route('index')}}" class="nav-item nav-link">Home</a>
                            <a href="/Shop" class="nav-item nav-link">Shop</a>
                            <a href="{{route('pages.index')}}" class="nav-item nav-link">Contact</a>
                            <a href="{{route('about_Us')}}" class="nav-item nav-link">About</a>
                            <a href="{{route('display_faqs')}}" class="nav-item nav-link">FAQs</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="{{route('Cart.index')}}" class="dropdown-item">Cart</a>
                                    <a href="{{route('Cart.wishlistshow')}}" class="dropdown-item">Wishlist</a>
                                    <a href="{{route('chackout')}}" class="dropdown-item">Chackout</a>
                                    <a href="{{route('Testimonials')}}" class="dropdown-item">Testimonial</a>
                                    <a href="{{route('errors')}}" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                              
                            <a href="{{route('userdetail')}}" class=" me-4  my-auto">
                                <i class="fas fa-user fa-2x"></i>
                
                            </a>
                            <a href="{{route('Cart.index')}}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span id="totalcartitems" class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"></span>
                            </a>
                        
                            <a href="/Cart/wishlistshow" class="position-relative  my-auto">
                                <i class="fas fa-heart fa-2x"></i>
                                <span id="totalwishitems" class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"></span>
                            
                            </a>
                            
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> 

                    <div class="modal-body my-auto">
                        <div class="input-group w-50 mx-auto d-flex">
                            <input type="search" id="topbarsearch" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
<div class="row mt-4" id="topbarsearchbody">

</div>

<div id="topbarsearchpaginate">
    
</div>
                    
                    </div>
                
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
   <!-- Single Page Header start -->
   @php
   use App\Models\website_properties_card;
  $Cardsccccc= website_properties_card::get();  
  if(isset($page)){
$display ='d-none';
  }else{
    $display =' '; 
  }
   @endphp
   <div class="container-fluid page-header py-5 {{$display}} " style="  background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{asset('storage/'.$Cardsccccc[13]->icon)}});">
    @yield('banner','NO Value For banner')
</div>

       
        @yield('body','NO Value For Body')


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container ">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">{{$Website_details[0]->name}}</h1>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input id="subscribemail" class="form-control border-0 w-100 py-3 px-4 rounded-pill" name="mail" type="email" placeholder="Your Email">
                                <button type="submit" id="subscribebtn" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </form>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            {!!$Website_details[0]->additional_info!!}
                            {{-- <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Info</h4>
                            <a class="btn-link" href="/Shop">Shop</a>
                            <a class="btn-link" href="{{route('pages.index')}}">Contact Us</a>
                            <a class="btn-link" href="{{route('display_privacy')}}">Privacy Policy</a>
                            <a class="btn-link" href="{{route('display_terms')}}">Terms & Conditions</a>
                            <a class="btn-link" href="{{route('display_refund')}}">Return Policy</a>
                            <a class="btn-link" href="{{route('display_faqs')}}">FAQs</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Account</h4>
                            <a class="btn-link" href="{{route('userdetail')}}">My Account</a>
                            <a class="btn-link" href="{{route('Cart.index')}}">Shopping Cart</a>
                            <a class="btn-link" href="{{route('Cart.wishlistshow')}}">Shopping Wishlist</a>
                            <a class="btn-link" href="{{route('Order_history')}}">Order History</a>
                            <a class="btn-link" href="{{route('chackout')}}">Checkout</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Address: {{$Website_details[0]->address}}</p>
                            <p>Email: {{$Website_details[0]->email}}</p>
                            <p>Phone: {{$Website_details[0]->phone}}</p>
                            <p>Payment Accepted</p>
                            <img src="img/payment.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 text-start text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Fruitables.com</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-8 my-auto text-start text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed & Developed By M. Tayyab
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
     <!-- Froala Text Editor JS -->
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

    </body>

</html>