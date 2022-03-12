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
        newFeedback(null , 'برند با موفقیت ایجاد شد' );
        return back();
    }

    public function edit( Brand $brand)
    {
        return view('panel.brands.edit' , compact('brand'));
    }

    public function update(BrandRequest $request ,Brand $brand)
    {
        $brand->update([
            'name' => $request->name ,
            'status' => $request->status
        ]);
        newFeedback();
        return redirect()->route('panel.brands.index');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(['message' => 'برند ' . $brand->name.' با موفقیت حذف شد.']);
    }
}
