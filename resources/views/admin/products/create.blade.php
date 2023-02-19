@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Product</h3>
                    <a href="{{route('admin.products')}}" class="btn btn-sm btn-primary float-end">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                    @foreach ($errors->all() as $error )
                        <div>{{$error}}</div>
                    @endforeach
                        </div>
                    @endif

                    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                          <button class="nav-link" id="Color-tab" data-bs-toggle="tab" data-bs-target="#Color-tab-pane" type="button" role="tab" aria-controls="Color-tab-pane" aria-selected="false">
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
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" name="name" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Brand</label>
                                <select type="text" name="brand" class="form-control">
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->name}}">{{$brand->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Small Description(500 Word)</label>
                                <input type="text" name="small_description" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control"/>
                            </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <input type="text" name="meta_description" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label>Meta Keyword</label>
                                    <input type="text" name="meta_keyword" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="number" name="original_price" class="form-control"/>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="number" name="selling_price" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label>
                                        <input type="checkbox" name="trending" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" />
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
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Color-tab-pane" role="tabpanel" aria-labelledby="Color-tab" tabindex="0">
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
                        </div>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    @endsection
