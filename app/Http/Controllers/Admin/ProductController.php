<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Color;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
  public function index()
  {
    $products = Product::orderBy('id','ASC')->simplePaginate(5);
    return view('admin.products.index', compact('products'));
  }
  public function create()
  {
    $categories = Category::all();
    $brands = Brand::all();
    $colors = Color::all();
   return view('admin.products.create', compact('categories','brands','colors'));
  }

  public function store(ProductFormRequest $request)
  {
     $validatedData = $request->validated();
    //   dd($validatedData);
     $category = Category::findOrfail($validatedData['category_id']);
     $product = $category->products()->create([
      'category_id'=> $validatedData['category_id'],
      'name'=> $validatedData['name'],
      'slug'=> Str::slug($validatedData['slug']),
      'brand'=> $validatedData['brand'],
      'small_description'=> $validatedData['small_description'],
      'description'=> $validatedData['description'],
      'original_price'=> $validatedData['original_price'],
      'selling_price'=> $validatedData['selling_price'],
      'quantity'=> $validatedData['quantity'],
      'trending'=> $request->trending == true? '1': '0',
      'status'=> $request->status== true? '1': '0',
      'meta_title'=> $validatedData['meta_title'],
      'meta_keyword'=> $validatedData['meta_keyword'],
      'meta_description'=> $validatedData['meta_description'],
     ]);
    //  return $product->id;

    if($request->hasFile('image')){
       $uploadPath = 'upload/products/';
       $s = 1;
       foreach($request->file('image') as $imageFile){

        $extension = $imageFile->getClientOriginalExtension();
        $fileName = time().$s++.'.'.$extension;
        $imageFile->move($uploadPath,$fileName);
        $finalPathImage = $uploadPath.$fileName;

        $product->productImages()->create([
            'product_id'=> $product->id,
            'image'=>$finalPathImage,
        ]);
       }
    }
    if($request->colors){
        foreach($request->colors as $key=>$color){
            $product->productColors()->create([
                'product_id'=>$product->id,
                'color_id'=> $color,
                'quantity'=> $request->colorQuantity[$key] ?? 0
            ]);
        }
    }
    return redirect('admin/products')->with('message', 'Added Product Successfully');

  }
  public function edit(int $product_id)
  {
    // return $id;
    $categories = Category::all();
    $brands = Brand::all();
     $product =Product::findOrFail($product_id);
     $product_color = $product->productColors->pluck('color_id')->toArray();
     $colors = Color::whereNotIn('id',$product_color)->get();
     return view('admin.products.edit', compact('categories','brands','product','colors'));
  }

 public function update(ProductFormRequest $request, int $product_id)
 {

    $validatedData = $request->validated();

    $product = Category::findOrFail($validatedData['category_id'])
                           ->products()->where('id',$product_id)->first();
    if($product){
        $product->update([
            'category_id'=> $validatedData['category_id'],
            'name'=> $validatedData['name'],
            'slug'=> Str::slug($validatedData['slug']),
            'brand'=> $validatedData['brand'],
            'small_description'=> $validatedData['small_description'],
            'description'=> $validatedData['description'],
            'original_price'=> $validatedData['original_price'],
            'selling_price'=> $validatedData['selling_price'],
            'quantity'=> $validatedData['quantity'],
            'trending'=> $request->trending == true? '1': '0',
            'status'=> $request->status== true? '1': '0',
            'meta_title'=> $validatedData['meta_title'],
            'meta_keyword'=> $validatedData['meta_keyword'],
            'meta_description'=> $validatedData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'upload/products/';
            $s = 1;
            foreach($request->file('image') as $imageFile){

             $extension = $imageFile->getClientOriginalExtension();
             $fileName = time().$s++.'.'.$extension;
             $imageFile->move($uploadPath,$fileName);
             $finalPathImage = $uploadPath.$fileName;

             $product->productImages()->create([
                 'product_id'=> $product->id,
                 'image'=>$finalPathImage,
             ]);
            }
         }
    }
    return redirect('admin/products')->with('message', 'Updated Data Successfully');
 }

 public function deleteImage(int $image_id){
        $deleteImage = ProductImage::findOrFail($image_id);
             if(File::exists($deleteImage->image)){
               File::delete($deleteImage->image);
             }
             $deleteImage->delete();
    return redirect()->back()->with('message', 'Delete Image Successfully');
 }
 public function destroyProduct(int $product_id){
   $product = Product::findOrFail($product_id);

   if($product->ProductImages){
       foreach($product->ProductImages as $image){
        if(File::exists($image->image)){
            File::delete($image->image);
        }
       }
   }
   $product->delete();
   return redirect()->back()->with('message', 'Delete Product Successfully');

 }
}
