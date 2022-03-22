<?php


use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Panel\Banner\BannerController;
use App\Http\Controllers\Panel\Brand\BrandController;
use App\Http\Controllers\Panel\Product\AttributeController;
use App\Http\Controllers\Panel\Product\CategoryController;
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

    //OTP login
    Route::get('/login-otp' , [OTPController::class , 'showLoginView'])->name('otp.login');
    Route::post('/login-otp' , [OTPController::class , 'loginByOTP'])->name('otp.login');
    Route::post('/otp-check' , [OTPController::class , 'otpCheck'])->name('otp.check');
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

    });

Route::get('products/{image}/display-image' , [ProductController::class , 'displayImage'] )->name('panel.products.displayImage');


require __DIR__.'/auth.php';
