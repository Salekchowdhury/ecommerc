<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function index(){
     $colors = Color::all();
        return view('admin.colors.index',compact('colors'));
    }
    public function create(){
        return view('admin.colors.create');
    }
     public function store(ColorFormRequest $request){

        $validatedData = $request->validated();

        $color = Color::create([
            'name'=>$validatedData['name'],
            'code'=>$validatedData['code'],
            'status'=>$request->status==true? '1': '0',
        ]);

         return redirect('admin/colors')->with('message','Added Color Successfully');
    }

    public function edit(int $color_id){
        $color = Color::findOrFail($color_id);

        return view('admin.colors.edit', compact('color'));
    }
     public function update(ColorFormRequest $request, int $color_id){
        $validatedData = $request->validated();
        Color::find($color_id)->update([
            'name'=> $validatedData['name'],
            'code'=> $validatedData['code'],
            'status'=> $request->status? '1':'0',
        ]);


        return redirect('admin/colors')->with('message','Updated Color Successfully');
    }

    public function delete(int $color_id){
     $color = Color::findOrFail($color_id);
     $color->delete();
     return redirect('admin/colors')->with('message','Color Deleted Successfully');

    }
}
