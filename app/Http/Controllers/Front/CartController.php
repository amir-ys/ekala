<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CartRequest;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $carts = \Cart::getContent();
        return view('front.cart.cart', compact('carts'));
    }

    public function add(CartRequest $request)
    {
        $product = Product::query()->findOrFail($request->product_id);
       if (! \Cart::get($product->id)){
           \Cart::add([
               'id' => $product->id,
               'name' => $product->name,
               'price' => $product->price,
               'quantity' => $request->qty,
               'attributes' => $product->attributes()->withPivot('value')->get()->toArray(),
               'associatedModel' => $product
           ]);
       }
       return back();
    }

    public function remove($itemId)
    {
        \Cart::remove($itemId);
        return back();
    }

    public function clear()
    {
        \Cart::clear();
        return back();
    }

}
