<?php

use App\Http\Controllers\Panel\Brand\BrandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel/dashboard', function () {
    return view('panel.dashboard');
})->name('panel.dashboard');

Route::group(['prefix' => 'panel' , 'as' => 'panel.'] , function (){
    Route::resource('brands' , BrandController::class );
});
