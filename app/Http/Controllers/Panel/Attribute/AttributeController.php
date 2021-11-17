<?php

namespace App\Http\Controllers\Panel\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Attribute\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::paginate();
        return view('panel.attributes.index'  , compact('attributes'));
    }

    public function store(AttributeRequest $request)
    {
        Attribute::create([
            'name' => $request->name
        ]);
        newFeedback(null  , 'ویژگی با موفقیت ایجاد شد.');
        return back();
    }

    public function edit(Attribute $attribute)
    {
        return view('panel.attributes.edit' , compact('attribute'));
    }

    public function update(AttributeRequest $request , Attribute $attribute)
    {
        $attribute->update([
           'name' => $request->name
        ]);
        newFeedback(null  , 'ویژگی با موفقیت بروزرسانی شد.');
        return redirect()->route('panel.attributes.index');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(['message' => 'ویژگی ' .$attribute->name. ' با موفقیت حذف شد.']);
    }
}
