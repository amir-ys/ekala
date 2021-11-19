<?php

use App\Http\Controllers\Panel\Attribute\AttributeController;
use App\Http\Controllers\Panel\Brand\BrandController;
use App\Http\Controllers\Panel\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel/dashboard', function () {
    return view('panel.dashboard');
})->name('panel.dashboard');

Route::group(['prefix' => 'panel' , 'as' => 'panel.'] , function (){
    Route::resource('brands' , BrandController::class );
    Route::resource('attributes' , AttributeController::class );
    Route::resource('categories' , CategoryController::class );
});
