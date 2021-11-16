<?php
namespace App\Http\Controllers\Panel\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Brand\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate();
        return view('panel.brands.index'  , compact('brands'));
    }

    public function store(BrandRequest $request)
    {
        Brand::create([
            'name' => $request->name ,
           'status' => $request->status
        ]);
        return back();
    }
}
