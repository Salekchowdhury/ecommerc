@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Product</h3>
                    <a href="{{route('admin.products')}}" class="btn btn-sm btn-primary float-end">Back</a>
                </div>
                @if (session('message'))
                    <h3 class="alert alert-success">{{session('message')}}</h3>
                @endif
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                    @foreach ($errors->all() as $error )
                        <div>{{$error}}</div>
                    @endforeach
                        </div>
                    @endif

                    <form action="{{url('admin/product/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                            Home</button>
                        </li>
                        <li class="nav-item" role="presentation">

                          <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">
                            SEO Tags</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
                            Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                            Product Image</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">
                            Product Color</button>
                        </li>

                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="mt-3">
                            <div class="mb-3">
                                <label>Category</label>
                                <select type="text" name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $product->category_id? 'selected': ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" value="{{$product->name}}" name="name" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" value="{{$product->slug}}" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Brand</label>
                                <select type="text" name="brand" class="form-control">
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->name}} {{$brand->name == $product->brand? 'selected': ''}}">{{$brand->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Small Description(500 Word)</label>
                                <textarea type="text" rows="4" name="small_description" class="form-control">{{$product->small_description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea type="text" rows="4" name="description" class="form-control">{{$product->description}}</textarea>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <label>Meta Description</label>
                                    <input type="text" name="meta_description" value="{{$product->meta_description}}"  class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Meta Keyword</label>
                                    <input type="text" name="meta_keyword" value="{{$product->meta_keyword}}" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="number" value="{{$product->original_price}}" name="original_price" class="form-control"/>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="number" name="selling_price" value="{{$product->selling_price}}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending" {{$product->trending == '1'? 'checked': ''}} />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" {{$product->status == '1'? 'checked': ''}} />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label>Product Image</label>
                                    <input type="file" name="image[]" multiple accept="image/*" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                   @if ($product->productImages)

                                   <div class="row">
                                    @foreach ($product->productImages as $image)
                                    <div class="col-md-1">
                                        <img src="{{asset($image->image)}}" style="height: 80px; width:80px" class="border" alt='image'>
                                        <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block ">Remove</a>
                                        {{-- <a href="" class="d-block "><i class="fa-sharp fa-solid fa-trash"></i></a> --}}
                                    </div>
                                    @endforeach
                                   </div>


                                       @else
                                       <h3>No Image</h3>
                                   @endif

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label>Select Color</label>
                                    <div class="row">
                                        @foreach ($colors as $color )
                                        <div class="col-md-3">
                                            <div class="p-2 mb-3 border">
                                            {{$color->name}}: <input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}"/>
                                            <br/>
                                            Quantity: <input type="number" name="colorQuantity[{{$color->id}}]" style="width: 70px;  border: 1 solid black"/>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Color Name</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productColors as $color )
                                        <tr class="prouct-color-tr">
                                            <td>{{$color->colors->name}}</td>
                                            <td>
                                                <div class="input-group mb-3" style="width: 150px">
                                                   <input type="number" value="{{$color->quantity}}" class="productColorQuantity form-control form-control-sm" />
                                                     <button type="button" value="{{$color->id}}" class="updateProductColorbtn btn btn-primary btn-sm">Update</button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" value="{{$color->id}}" class="deleteProductColorbtn btn btn-danger btn-sm">Delete</button>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-success">Update</button>
                      </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
      <script>
        $(document).ready(function(){
            $(document).on('click', '.updateProductColorbtn', function(){
                var product_color_id = $(this).val();
                alert(product_color_id);
            });
        });
      </script>

    @endsection
