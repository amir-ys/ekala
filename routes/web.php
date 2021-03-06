<?php


use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CommentController as FrontCommentController;
use App\Http\Controllers\Front\CompareController;
use App\Http\Controllers\Front\CouponController as FrontCouponController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\TransactionController;
use App\Http\Controllers\Panel\Banner\BannerController;
use App\Http\Controllers\Panel\Brand\BrandController;
use App\Http\Controllers\Panel\CouponController;
use App\Http\Controllers\Panel\Order\OrderController as PanelOrderController;
use App\Http\Controllers\Panel\Product\AttributeController;
use App\Http\Controllers\Panel\Product\CategoryController;
use App\Http\Controllers\Panel\Product\CommentController;
use App\Http\Controllers\Panel\Product\ProductController;
use App\Http\Controllers\Panel\Product\TagController;
use App\Http\Controllers\Panel\RolePermission\PermissionController;
use App\Http\Controllers\Panel\RolePermission\RoleController;
use App\Http\Controllers\Panel\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/panel/dashboard', function () {
    return view('panel.dashboard');
})->name('panel.dashboard')->middleware('auth');

Route::get('test' , function (){

    $user = \App\Models\User::find(2);
    $user->notify(NEW \App\Notifications\OTPSms('12345'));

});

// Front
Route::group([],  function (){
    Route::get('/' , [FrontController::class , 'index'])->name('home');
    Route::get('/categories/{category:slug}' ,[FrontController::class , 'showCategory'])->name('front.show-category');
    Route::get('/product/{product:slug}' ,[FrontController::class , 'productDetails'])->name('products.details');
    Route::get('/auth/google/redirect' ,[GoogleAuthController::class , 'redirect'])->name('auth.google.redirect');
    Route::get('/auth/google/callback' ,[GoogleAuthController::class , 'callback'])->name('auth.google.callback');

    Route::post('comments/{product}/store' , [FrontCommentController::class , 'store'])->name('comment.store')->middleware('auth');

    //OTP login
    Route::get('/login-otp' , [OTPController::class , 'showLoginView'])->name('otp.login');
    Route::post('/login-otp' , [OTPController::class , 'loginByOTP'])->name('otp.login');
    Route::post('/otp-check' , [OTPController::class , 'otpCheck'])->name('otp.check');

    Route::post('/add-to-wish/{product}' , [\App\Http\Controllers\Front\WishController::class , 'add'])->name('products.wish.store');
    Route::delete('/delete-from-wish/{product}' , [\App\Http\Controllers\Front\WishController::class , 'delete'])->name('products.wish.delete');

    Route::get('compare' , [CompareController::class , 'index'])->name('products.compare.index');
    Route::get('compare/{product}/add' , [CompareController::class , 'add'])->name('products.compare.add');
    Route::get('compare/{product}/delete' , [CompareController::class , 'delete'])->name('products.compare.delete');

    Route::get('cart' , [CartController::class , 'index'])->name('front.cart.index');
    Route::post('cart/add' , [CartController::class , 'add'])->name('front.cart.add');
    Route::delete('cart/{id}/remove' , [CartController::class , 'remove'])->name('front.cart.remove');
    Route::delete('cart/remove' , [CartController::class , 'clear'])->name('front.cart.clear');

    Route::get('coupon/check' , [FrontCouponController::class , 'checkCoupon'])->name('front.coupon.check');

    Route::get('/checkout' , [OrderController::class , 'checkout'])->name('front.orders.checkout');
    Route::post('/pay' , [OrderController::class , 'pay'])->name('front.orders.pay')->middleware('auth');
    Route::get('/payment/callback' , [TransactionController::class , 'callback'])->name('front.transaction.callback')->middleware('auth');
});

//Panel
Route::group(
    [   'prefix' => 'panel' ,
        'as' => 'panel.' ,
        'middleware' => 'auth' ,
    ]  , function (){
    Route::resource('brands' , BrandController::class );
    Route::resource('attributes' , AttributeController::class );
    Route::resource('categories' , CategoryController::class );
    Route::resource('users' , UserController::class );
    Route::resource('permissions' , PermissionController::class );
    Route::resource('roles' , RoleController::class );
    Route::resource('tags' , TagController::class );
    Route::resource('products' , ProductController::class );
    Route::resource('comments' , CommentController::class )->only('index' , 'destroy');
    Route::post('comments/{comment}/change-status' , [CommentController::class , 'changeStatus'] )->name('comments.changeStatus');
    Route::resource('orders' , PanelOrderController::class );


    //products
    Route::get('products/{product}/images' , [ProductController::class , 'uploadImagesView'] )->name('products.uploadImages.view');

    //product image
    Route::delete('products/image/{image}/delete' , [ProductController::class , 'deleteImage'] )->name('products.image.delete');
    Route::delete('products/{product}/image/deleteAll' , [ProductController::class , 'deleteAllImage'] )->name('products.image.deleteAll');
    Route::post('products/{product}/image/upload' , [ProductController::class , 'uploadImage'] )->name('products.image.upload');

    //product attribute
    Route::get('products/{product}/attribute' , [ProductController::class , 'productAttributeView'] )->name('products.attribute.view');
    Route::get('products/{product}/attribute/store' , [ProductController::class , 'productAttributeStore'] )->name('products.attribute.store');

    //banner
    Route::resource('banners' , BannerController::class);
    Route::resource('coupons' , CouponController::class);

    });

Route::get('products/{image}/display-image' , [ProductController::class , 'displayImage'] )->name('panel.products.displayImage');


require __DIR__.'/auth.php';
