<?php

namespace App\Http\Controllers\Panel\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Banner\BannerRequest;
use App\Models\Banner;
use App\Services\Media\MediaFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::query()->latest()->paginate();
        return view('panel.banners.index' , compact('banners'));
    }

    public function create()
    {
        return view('panel.banners.create');
    }

    public function store(BannerRequest $request)
    {
       $banner = Banner::create([
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
            'status' => $request->status,
            'type' => $request->type,
            'btn_link' => $request->btn_link,
            'btn_text' => $request->btn_text,
            'btn_icon' => $request->btn_icon,
       ]);

        if ($request->hasFile('image')){
           MediaFileService::publicUpload($request->image , $banner);
        }
        return redirect()->route('panel.banners.index');
    }

    public function edit(Banner $banner)
    {
        return view('panel.banners.edit' , compact('banner'));
    }

    public function update(BannerRequest  $request , Banner $banner)
    {
        $banner->update([
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
            'status' => $request->status,
            'type' => $request->type,
            'btn_link' => $request->btn_link,
            'btn_text' => $request->btn_text,
            'btn_icon' => $request->btn_icon,
        ]);

        if ($request->hasFile('image')){
            if ( $image =  $banner->image()->first()){
                $banner->image()->delete();
                MediaFileService::delete($image);
            }
            MediaFileService::publicUpload($request->image ,$banner);
        }
        return redirect()->route('panel.banners.index');
    }

    public function destroy(Banner $banner): JsonResponse
    {
        $banner->image()->delete();
        $banner->delete();
        return response()->json([
           'message' => 'بنر ' .$banner->title. ' با موفقیت حذف شد.'
        ]);
    }
}
