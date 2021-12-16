<?php


use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Panel\Brand\BrandController;
use App\Http\Controllers\Panel\Product\AttributeController;
use App\Http\Controllers\Panel\Product\CategoryController;
use App\Http\Controllers\Panel\RolePermission\PermissionController;
use App\Http\Controllers\Panel\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/panel/dashboard', function () {
    return view('panel.dashboard');
})->name('panel.dashboard');

// Front
//Route::group([],  function (){
    Route::get('/' , [FrontController::class , 'index']);
//});

//Panel
Route::group(['prefix' => 'panel' , 'as' => 'panel.'] , function (){
    Route::resource('brands' , BrandController::class );
    Route::resource('attributes' , AttributeController::class );
    Route::resource('categories' , CategoryController::class );
    Route::resource('users' , UserController::class );
    Route::resource('permissions' , PermissionController::class );
});

require __DIR__.'/auth.php';
