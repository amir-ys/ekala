<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{

    public function index()
    {
        if (session()->has('compareProduct') && !empty(session()->get('compareProduct'))) {
            $products = Product::query()->whereIn('id', session()->get('compareProduct'))->get();
            return view('front.compare', compact('products'));
        }
        session()->forget('compareProduct');
        return redirect()->route('home');
    }


    public function add($productId)
    {
        if (session()->has('compareProduct') && in_array($productId, session()->get('compareProduct'))) {
            if (count(session()->get('compareProduct')) >= 2) {
                return redirect()->route('products.compare.index');
            }
            return redirect()->route('home');
        } else {
            session()->push('compareProduct', $productId);
        }

        if (count(session()->get('compareProduct')) >= 2) {
            return redirect()->route('products.compare.index');
        }
        return redirect()->route('home');

    }

    public function delete($productId)
    {
        $productIds = session()->get('compareProduct');
        foreach ($productIds as $key => $compareProductId) {
            if ( $compareProductId == $productId) {
                session()->pull('compareProduct.' . $key);
            }
            return back();
        }
    }
}
