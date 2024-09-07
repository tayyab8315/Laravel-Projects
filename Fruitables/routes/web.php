<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\wishController;
use App\Http\Middleware\AdminTaskOrders;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\AdminTaskWebiste;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\AdminTaskProducts;
use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Middleware\AuthenticateSuperAdmin;
use App\Http\Controllers\product_cat_controller;

Route::get('/',[IndexController::class,'index'])->name('index');



Route::get('/env-test', function () {
    // $previousUrl = URL::previous();
    // $previousRoute = Route::getRoutes()->match(Request::create($previousUrl))->getName();
    return [
        'APP_NAME' => config('app.name') ,
        'PAYPAL_CLIENT_ID' =>config('paypal.client_id'),
        'PAYPAL_CLIENT_SECRET' => env('PAYPAL_CLIENT_SECRET'),
    ];
});

// routes/web.php


Route::get('errors',function(){
    return view('errors.404');
})->name('errors');
Route::post('/pordcat', [ProductController::class, 'showcat'])->name('pordcat');
// product_cat_controller

Route::match(['get', 'post'],'/user/gotoGoogle', [UserController::class, 'gotoGoogle'])->name('user.gotoGoogle');
Route::match(['get', 'post'],'/user/google', [UserController::class, 'returnfromGoogle'])->name('user.google');
Route::match(['get', 'post'],'/user/gotofacebook', [UserController::class, 'gotofacebook'])->name('user.gotofacebook');
Route::match(['get', 'post'],'/user/facebook', [UserController::class, 'returnfromfacebook'])->name('user.facebook');
Route::middleware([AuthenticateUser::class])->group(function () {
    
    Route::resource('/wish',wishController::class);
    Route::post('/wish/store', [wishController::class, 'store'])->name('wish.store');

    Route::get('userdetail',function(){
        return view('user.user');
    })->name('userdetail');
    Route::match(['get', 'post'],'/logout', [UserController::class, 'logout'])->name('logout');
    Route::match(['get', 'post'],'/Order_history', [UserController::class, 'Order_history'])->name('Order_history');
    Route::get('Testimonials',[IndexController::class,'Testimonials'])->name('Testimonials');
    Route::get('about_Us',[IndexController::class,'about_Us'])->name('about_Us');
    Route::resource('/pages',PagesController::class);
    Route::get('display_terms',  [PagesController::class,'display_terms'])->name('display_terms');
    Route::get('display_refund',  [PagesController::class,'display_refund'])->name('display_refund');
    Route::get('display_privacy',  [PagesController::class,'display_privacy'])->name('display_privacy');
    Route::get('display_faqs',  [PagesController::class,'display_faqs'])->name('display_faqs');




// Shop Controller
Route::resource('/Shop',ShopController::class);
Route::get('/Shop/index',  [ShopController::class,'index'])->name('Shop.index');
Route::get('/Shop/{id}/show',[ShopController::class,'show'])->name('Shop.show');
Route::get('/Shop/{id}/edit',[ShopController::class,'edit'])->name('Shop.edit');
Route::post('/Shop/range',[ShopController::class,'range'])->name('Shop.range');
Route::post('/Shop/search',[ShopController::class,'search'])->name('Shop.search');
Route::post('/Shop/topbarsearch',[ShopController::class,'topbarsearch'])->name('Shop.topbarsearch');
Route::post('/Shop/additional',[ShopController::class,'additional'])->name('Shop.additional');
// In your web.php (routes file)

// Comment Controller
Route::post('/save-comment', [CommentController::class, 'store'])->name('save.comment');

// Cart Controller
Route::resource('/Cart',CartController::class);
Route::match(['get', 'post'],'/Cart/store', [CartController::class, 'store'])->name('Cart.store');
Route::post('/Cart.updatecart', [CartController::class, 'updatecart'])->name('Cart.updatecart');
Route::match(['get', 'post'],'/Cart/{id}/destroy', [CartController::class, 'destroy'])->name('Cart.destroy');
Route::match(['get', 'post'],'/Cart/{id}/wishlist', [CartController::class, 'wishlist'])->name('Cart.wishlist');
Route::match(['get', 'post'],'/Cart/{id}/removewishlist', [CartController::class, 'removewishlist'])->name('Cart.removewishlist');
Route::match(['get', 'post'],'/wish/count', [CartController::class, 'wishcount'])->name('Cart.wishcount');
Route::match(['get', 'post'],'/Cart/count', [CartController::class, 'cartcount'])->name('Cart.cartcount');


Route::match(['get', 'post'],'/Cart/wishlistshow', [CartController::class, 'show'])->name('Cart.wishlistshow');


Route::match(['get', 'post'],'/Cart.Showpro', [CartController::class, 'Showpro'])->name('Cart.Showpro');
Route::match(['get', 'post'],'/chackout', [CartController::class, 'chackout'])->name('chackout');


// payment Controller
Route::match(['get', 'post'],'/payment', [PaymentController::class, 'payment'])->name('payment');
Route::match(['get', 'post'],'/payment/success', [PaymentController::class, 'success']);
Route::match(['get', 'post'],'/payment/error', [PaymentController::class, 'error']);

Route::match(['get', 'post'],'/Order/MailVerified/{order_number}', [OrderController::class, 'verifymail'])->name('MailVerified');
Route::match(['get', 'post'],'/Order/store', [OrderController::class, 'store'])->name('Order.store');
Route::match(['get', 'post'],'/Order/search_order', [OrderController::class, 'search_order'])->name('Order.search_order');


});




Route::resource('/user',UserController::class);
Route::post('/user/mail',  [UserController::class,'sendmail'])->name('user.mail');
Route::post('/user/login',  [UserController::class,'login'])->name('user.login');
Route::get('/user/{token}/{task}/show', [UserController::class, 'show'])->name('user.show');
Route::post('/user/{token}/update', [UserController::class, 'update'])->name('user.update');
Route::post('/user/reset',  [UserController::class,'reset'])->name('user.reset');
Route::match(['get', 'post'],'/reset-form', [UserController::class, 'resetForm'])->name('reset-form');
Route::match(['get', 'post'],'/user/subscription',  [UserController::class,'subscription'])->name('user.subscription');



//   ------------------------------------- Admin Routes Starts Here---------------------------------------------
Route::match(['get', 'post'],'/admin/signin', [AdminController::class, 'show'])->name('admin.signin');
Route::match(['get', 'post'],'/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::match(['get', 'post'],'/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::match(['get', 'post'],'/admin/store', [AdminController::class, 'login'])->name('admin.store');
Route::get('/admin/index',[AdminController::class,'index'])->name('admin.index');
Route::resource('/admin', AdminController::class);
Route::match(['get', 'post'],'/signout', [AdminController::class,'signout'])->name('admin.signout');
Route::match(['get', 'post'],'/forgetpass', [AdminController::class,'forgetpass'])->name('admin.forgetpass');
Route::match(['get', 'post'],'/verifyadmin', [AdminController::class,'verifyadmin'])->name('admin.verifyadmin');
Route::get('/admin/{token}/verified', [AdminController::class,'verified'])->name('admin.verified');
Route::match(['get', 'post'],'/admin/{token}/lastupd', [AdminController::class,'lastupd'])->name('admin.lastupd');

Route::resource('/Order',OrderController::class);


Route::middleware([AuthenticateSuperAdmin::class])->group(function () {
    Route::get('/admin/{id}/edit', [AdminController::class,'edit'])->name('admin.edit');
    Route::get('/admin/{id}/make', [AdminController::class,'make'])->name('admin.make');
    Route::get('/admin/{id}/destroy', [AdminController::class,'destroy'])->name('admin.destroy');
    Route::get('/admin/{id}/{task}/task', [AdminController::class,'task'])->name('admin.task');
    Route::get('/manage_admin',[AdminController::class,'manage_admin'])->name('manage_admin');
    Route::get('/manage_Super_admin',[AdminController::class,'manage_Super_admin'])->name('manage_Super_admin');
   
});



Route::middleware([AuthenticateAdmin::class])->group(function () {
Route::middleware([AdminTaskWebiste::class])->group(function () {
Route::resource('/Web', WebController::class);
Route::match(['get', 'post'],'/Web/{id}/update',  [WebController::class,'update'])->name('Web.update');
Route::match(['get', 'post'],'/Web/{id}/Info_Update',  [WebController::class,'Info_Update'])->name('Web.Info_Update');
Route::post('/Web/store', [WebController::class, 'store']);
Route::get('/Web/web_info', [WebController::class, 'show'])->name('web_info');
Route::post('/Web/updateCard', [WebController::class, 'updateCard'])->name('updateCard');

Route::match(['get', 'post'],'/pages/create', [PagesController::class, 'create'])->name('pages.create');
Route::match(['get', 'post'],'/pages/teamdetails', [PagesController::class, 'teamdetails']);
Route::match(['get', 'post'],'/pages/about_us_modified', [PagesController::class, 'about_us_modified'])->name('pages.about_us_modified');

Route::match(['get', 'post'],'/pages/terms_modified', [PagesController::class, 'terms_modified'])->name('pages.terms_modified');

Route::get('/policy_form', [PagesController::class, 'policy_form'])->name('policy_form');
Route::match(['get', 'post'],'/terms_conditions', [PagesController::class, 'terms_conditions'])->name('terms_conditions');
Route::resource('/Faqs',FaqsController::class);
Route::get('/Faqs/{id}/show',  [FaqsController::class,'show'])->name('Faqs.show');
Route::match(['get', 'post'],'/Faqs/{id}/destroy',  [FaqsController::class,'destroy'])->name('Faqs.destroy');
Route::match(['get', 'post'],'/Faqs/{id}/update',  [FaqsController::class,'update'])->name('Faqs.update');
Route::match(['get', 'post'],'/Faqs/{id}/edit',  [FaqsController::class,'edit'])->name('Faqs.edit');

Route::resource('/Review',CommentController::class);
Route::match(['get', 'post'],'/Review/{id}/destroy',  [CommentController::class,'destroy'])->name('Review.destroy');
Route::match(['get', 'post'],'/Review/{id}/edit',  [CommentController::class,'edit'])->name('Review.edit');
Route::resource('/contacts',ContactController::class);
Route::match(['get', 'post'],'/contacts/{id}/destroy',  [ContactController::class,'destroy'])->name('contacts.destroy');
Route::match(['get', 'post'],'/contacts/{id}/edit',  [ContactController::class,'edit'])->name('contacts.edit');


});


Route::middleware([AdminTaskOrders::class])->group(function () {

// Route::get('/Order/{order_status?}',[OrderController::class,'index'])->name('Order.index');
Route::get('/Order/{order_status}/Order_details', [OrderController::class,'Order_details'])->name('Order_details');
Route::get('/Order/{order_number}/user_details', [OrderController::class,'user_details'])->name('user_details');
Route::get('/Order/{order_number}/{order_status}/order_status', [OrderController::class,'order_status'])->name('order_status');
// Route::get('/Order/{order_num}/show',[OrderController::class,'show'])->name('Order.show');
Route::get('/Order/{order_num}/show',[OrderController::class,'show'])->name('Order.show');
Route::get('/Order/{order_number}/edit',[OrderController::class,'edit'])->name('Order.edit');
 
});

Route::middleware([AdminTaskProducts::class])->group(function () {
    


Route::resource('/Product-cat', product_cat_controller::class);
Route::get('/Product-cat/{id}/show',  [product_cat_controller::class,'show'])->name('Product-cat.show');
Route::match(['get', 'post'],'/Product-cat/{id}/update',  [product_cat_controller::class,'update'])->name('Product-cat.update');
Route::match(['get', 'post'],'/Product-cat/{id}/destroy',  [product_cat_controller::class,'destroy'])->name('Product-cat.destroy');

// Product_Sub_Category Controller 
Route::resource('/Product-Subcat', SubCategoryController::class);
Route::get('/Product-Subcat/{id}/show',  [SubCategoryController::class,'show'])->name('Product-Subcat.show');
Route::match(['get', 'post'],'/Product-Subcat/{id}/update',  [SubCategoryController::class,'update'])->name('Product-Subcat.update');
Route::match(['get', 'post'],'/Product-Subcat/{id}/destroy',  [SubCategoryController::class,'destroy'])->name('Product-Subcat.destroy');

// Product Controller
Route::resource('/Product', ProductController::class);
Route::match(['get', 'post'],'/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories'])->name('getSubcategories');
Route::get('/Product/{id}/show',[ProductController::class,'show'])->name('Product.show');
Route::get('/Product/{id}/edit',[ProductController::class,'edit'])->name('Product.edit');
Route::get('/Product/{id}/feature',[ProductController::class,'feature'])->name('Product.feature');
Route::get('/Product/{id}/sale',[ProductController::class,'sale'])->name('Product.sale');
Route::match(['get', 'post'],'/Product/{id}/update',  [ProductController::class,'update'])->name('Product.update');
Route::match(['get', 'post'],'/Product/{id}/destroy',  [ProductController::class,'destroy'])->name('Product.destroy');
Route::get('/products/category/{id}',  [ProductController::class,'getProductsByCategory'])->name('products.by.category');
});
});

