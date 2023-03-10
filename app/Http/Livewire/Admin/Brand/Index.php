<?php

namespace App\Http\Livewire\Admin\Brand;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
class Index extends Component
{

use WithPagination;
protected $paginationTheme = 'bootstrap';

public $name, $slug, $status, $brand_id;

public function rules()
{
   return[
    'name'=> 'required|string',
    'slug'=> 'required|string',
    'status'=> 'nullable',
   ];
}

public function clearForm()
{
  $this->name = null;
  $this->slug = null;
  $this->status = null;
  $this->brand_id = null;
}

public function storeBrand()
{
   $validatedData = $this->validate();

   Brand::create([
    'name' => $this->name,
    'slug' => Str::slug($this->slug),
    'status' => $this->status == true? '1': '0' ,
   ]);
   $this->clearForm();
   session()->flash('message', 'Added Brand Successfully');
}

public function editBrand(int $brand_id)
{
$this->brand_id = $brand_id;

 $brand = Brand::findOrFail($brand_id);
 $this->name = $brand->name;
 $this->slug = $brand->slug;
 $this->status = $brand->status;
}

public function updateBrand()
{
    $validatedData = $this->validate();
    Brand::findOrFail($this->brand_id)->update([
        'name' => $this->name,
        'slug' => Str::slug($this->slug),
        'status' => $this->status == true? '1': '0',
    ]);

    $this->clearForm();
    session()->flash('message', 'Updated Brand Successfully');
}

public function deleteBrand($brand_id)
{
  $this->brand_id = $brand_id;
}
public function destroyBrand()
{
  Brand::findOrFail($this->brand_id)->delete();
  session()->flash('message', 'Deleted Brand Successfully');

}
    public function render()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.brand.index',['brands'=> $brands])
                     ->extends('layouts.admin')
                     ->section('content');
    }
}
