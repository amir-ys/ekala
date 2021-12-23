<?php

namespace App\Http\Controllers\Panel\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Product\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate();
        return view('panel.tags.index'  , compact('tags'));
    }

    public function store(TagRequest $request)
    {
        Tag::create([
            'name' => $request->name
        ]);
        newFeedback(null  , 'برچسب با موفقیت ایجاد شد.');
        return back();
    }

    public function edit(Tag $tag)
    {
        return view('panel.tags.edit' , compact('tag'));
    }

    public function update(TagRequest $request , Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);
        newFeedback(null  , 'برچسب با موفقیت بروزرسانی شد.');
        return redirect()->route('panel.tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'برچسب ' .$tag->name. ' با موفقیت حذف شد.']);
    }
}
