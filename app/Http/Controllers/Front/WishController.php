<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function add(Product $product)
    {
        if ($product->wishes()->where('user_id' , auth()->id())->first()){
            return  back();
        }
        Wishlist::query()->create([
            'user_id' => auth()->id() ,
            'product_id' => $product->id ,
        ]);
        return back();
    }

    public function delete(Product $product): RedirectResponse
    {
        if ($wish =  $product->wishes()->where('user_id' , auth()->id())->first()){
            $wish->delete();
            return  back();
        }
        return  back();
    }

}
