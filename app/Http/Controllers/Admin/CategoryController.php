<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    function create()
    {
       return view('admin.category.create');
    }
    public function store(CategoryFormRequest $reguest)
    {
        $validatedData = $reguest->validated();
        // dd($validatedData);
        $category = new Category ;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'] ;
      if($reguest->hasFile('image')){
         $file = $reguest->file('image');
         $ext = $file->getClientOriginalExtension();
         $fileName = time().'.'.$ext;

         $file->move('uploads/category/', $fileName);
         $category->image = $fileName;
      }
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];

        $category->status = $reguest['status'] == true ? '1' : '0' ;
        $category->save();

        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    public function update(CategoryFormRequest $reguest, $category)
    {
       $validatedData = $reguest->validated();

       $category = category::findOrFail($category);

       $category->name = $validatedData['name'];
       $category->slug = Str::slug($validatedData['slug']);
       $category->description = $validatedData['description'] ;
     if($reguest->hasFile('image')){

        $path = 'uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $file = $reguest->file('image');
        $ext = $file->getClientOriginalExtension();
        $fileName = time().'.'.$ext;

        $file->move('uploads/category/', $fileName);
        $category->image = $fileName;
     }
       $category->meta_description = $validatedData['meta_description'];
       $category->meta_title = $validatedData['meta_title'];
       $category->meta_keyword = $validatedData['meta_keyword'];

       $category->status = $reguest['status'] == true ? '1' : '0' ;
       $category->update();

       return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }
}
