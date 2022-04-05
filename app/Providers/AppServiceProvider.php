<?php

namespace App\Providers;

use App\Gateways\Gateway;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton(Gateway::class , function (){
            $paymentMethod = cache()->get('payment_method');
            $gatewayMethods =  array_keys(config('payment_method'));
            foreach ($gatewayMethods as $gatewayMethod){
                if ($paymentMethod == $gatewayMethod ){
                    $className = config('payment_method.' . $gatewayMethod. '.class');
                   return new $className();
                }
            }

        });

        Paginator::useBootstrap();
        View::composer('front.layouts.header' , function ($view){
           $view->with([
               'categories' => Category::query()->whereNull('parent_id')->get() ,
               'carts' => \Cart::getContent(),
               ]);
        });
    }
}
