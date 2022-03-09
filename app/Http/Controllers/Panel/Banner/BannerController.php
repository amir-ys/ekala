<?php

namespace App\Http\Controllers\Panel\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Banner\BannerRequest;
use App\Models\Banner;
use App\Services\Media\MediaFileService;
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
//        dd(1);
//        if ($request->hasFile('image')){
//            MediaFileService::publicUpload($request->image , );
//        }
        Banner::create([
            'image' => 1,
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
            'status' => $request->status,
            'type' => $request->type,
            'btn_link' => $request->btn_link,
            'btn_text' => $request->btn_text,
            'btn_icon' => $request->btn_icon,
        ]);
        return redirect()->route('panel.banners.index');
    }
}
