<?php

namespace App\Http\Controllers\Panel\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Product\ProductAttributeRequest;
use App\Http\Requests\Panel\Product\StoreProductRequest;
use App\Http\Requests\Panel\Product\UpdateProductRequest;
use App\Http\Requests\Panel\Product\UploadImageRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\Tag;
use App\Services\Media\MediaFileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->latest()->paginate();
        return view('panel.products.index' , compact('products'));
    }
    public function create()
    {
        $brands =Brand::all();
        $categories =Category::all();
        $tags = Tag::all();
        return view('panel.products.create' , compact('brands' , 'categories' , 'tags'));
    }

    public function show(Product $product)
    {
        $brands =Brand::all();
        $categories =Category::all();
        $tags = Tag::all();
        return view('panel.products.show' , compact('product'  , 'brands' , 'categories' , 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        DB::transaction(function () use ($request) {

            //store products
            $product =  Product::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'status' => $request->status,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);


            // attach tags to product
            $tag_ids = $request->tag_ids;
            foreach ($tag_ids as $tag_id){
            $product->tags()->attach($tag_id);
            }

            //upload file
            //primary
            if ($request->hasFile('primary_image')){
                MediaFileService::publicUpload($request->primary_image , $product , 'products' , true );
            }

            //other images
            if ($request->hasFile('images') ){
                $images = $request->images;
                foreach ($images as $image){
                    MediaFileService::publicUpload($image , $product , 'products' , false );
                }
            }

        });
        return redirect()->route('panel.products.index');
    }

    public function edit(Product $product)
    {
        $brands =Brand::all();
        $categories =Category::all();
        $tags = Tag::all();
        return view('panel.products.edit' , compact('brands' , 'categories', 'tags' ,'product'));
    }

    public function update(UpdateProductRequest $request , Product $product)
    {
        //update products
        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status,
            'delivery_amount' => $request->delivery_amount,
            'delivery_amount_per_product' => $request->delivery_amount_per_product,
        ]);

        //upload file
        //primary
        if ($request->hasFile('primary_image')){
            if ($primary = $product->images()->where('is_primary' , 1)->first()){
            MediaFileService::delete($primary);
            }
            MediaFileService::publicUpload($request->primary_image , $product , 'products' , true );
        }

        //other images
        if ($request->hasFile('images') ){
            foreach ($product->images() as $image){
                MediaFileService::delete($image);
            }
            $images = $request->images;
            foreach ($images as $image){
                MediaFileService::publicUpload($image , $product , 'products' , false );
            }
        }

        //sync products
        $product->tags()->sync($request->tag_ids);

        return redirect()->route('panel.products.index') ;
    }

    public function destroy(Product  $product)
    {
        MediaFileService::delete($product->images()->where('is_primary' , 1)->firstOr());
        foreach ($product->images() as $image){
            MediaFileService::delete($image);
        }
        $product->images()->delete();
        $product->tags()->delete();
        $product->delete();

        return response()->json([
            'message' => 'محصول ' . $product->name.' با موفقیت حذف شد.'        ]);
    }

    public function uploadImagesView( Product $product)
    {
        $primaryImage = $product->images()->where('is_primary' , 1)->first();
        $images = $product->images()->where('is_primary' , 0)->get();
        return view('panel.products.upload-image' ,compact('product' ,
            'primaryImage' , 'images'
        ));
    }

   public function displayImage($filename)
    {
        $dir = 'public';
        $path =  $filename;
        if (!Storage::disk($dir)->exists($path)) {
            abort(404);
        };

        $path = $dir . '\\' . $path;
        $file = Storage::get($path);
        $mimes = Storage::mimeType($path);
        $response = response()->make($file, ResponseAlias::HTTP_OK);
        $response->header('Content-Type', $mimes);
        return $response;
    }

    public function deleteImage($imageId)
    {
        $image = Media::query()->where('id' , $imageId)->first();
        if (!$image){
            newFeedback(  'عملیات ناموفق' ,'عکسی با این شناسه پیدا نشد.');
            return back();
        }
        $image->delete();
        MediaFileService::delete($image);
        newFeedback(  'عملیات موفق' ,'فایل با موفقیت حذف شد');
        return  back();
    }

    public function deleteAllImage(Product $product)
    {
        $images = Media::query()->where('product_id' , $product->id)->get();
        if ($images->count() <= 0 ){
            newFeedback(  'عملیات ناموفق' ,'عکسی با این شناسه پیدا نشد.');
            return back();
        }
        foreach ($images as $image){
            $image->delete();
            MediaFileService::delete($image);
        }
        newFeedback(  'عملیات موفق' ,'فایل با موفقیت حذف شد');
        return  back();
    }

    public function uploadImage(UploadImageRequest $request , Product $product)
    {
        if ($request->hasFile('primary_image')){
            if ( $image =  $product->images()->where('is_primary' , 1)->first()){
                $image->delete();
                MediaFileService::delete($image);
            }
            MediaFileService::publicUpload($request->primary_image , $product , '' , true );
        }elseif ($request->hasFile('images')){
            $images = $request->images;
            foreach ($images as $image){
                MediaFileService::publicUpload($image , $product , '' , false );
            }
        }
        newFeedback(  'عملیات موفق' ,'فایل با موفقیت آپلود شد');
        return back();
    }

    public function productAttributeView(Product  $product)
    {
        return view('panel.products.product-attribute' , compact('product'));
    }

    public function productAttributeStore(ProductAttributeRequest $request , Product  $product)
    {
        $attributes = $request->attribute_ids;
        $product->attributes()->sync([]);
        foreach ($attributes as  $attributeId => $attributeValue){
            $product->attributes()->attach([ $attributeId ] , ['value' => $attributeValue]);
        }
        return redirect()->route('panel.products.index');
    }
}
