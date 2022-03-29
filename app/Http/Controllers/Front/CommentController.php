<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function store(Request $request , Product $product)
    {
        $validate  =Validator::make($request->all() , [
            'body' => ['required' , 'string'] ,
        ]);

        if ($validate->fails()){
            return redirect()->to(url()->previous() . '#comment')
                ->withErrors($validate) ;
        }

       Comment::query()->create([
           'body' => $request->body,
           'user_id' => auth()->id() ,
           'commentable_type' => get_class($product) ,
           'commentable_id' => $product->id ,
       ]);
        return  redirect()->to(url()->previous() . '#comment')->with(['message' => 'کامنت شما پس از تایید مدیریت نمابش داده میشود'] );
    }
}
