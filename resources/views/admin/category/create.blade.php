@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                    <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-primary float-end">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/category')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" />
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Slug</label>
                                <input type="text" name="slug" class="form-control" />
                                @error('slug') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Description</label>
                                <textarea type="text" name="description" class="form-control" rows="3"></textarea>
                                @error('description') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" />
                                @error('image') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Status</label>
                            <br/>
                                <input type="checkbox" name="status" />
                                @error('status') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                            <div class="col-md-12 mb-1">
                                <h4>SEO Tags</h4>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" />
                                @error('meta_title') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                           <div class="col-md-12 mb-3">
                                <label for="">Meta Keyward</label>
                                <textarea type="text" name="meta_keyword" class="form-control" rows="3"></textarea>
                                @error('meta_keyword') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                           <div class="col-md-12 mb-3">
                                <label for="">Meta Description</label>
                                <textarea type="text" name="meta_description" class="form-control" rows="3"></textarea>
                                @error('meta_description') <small class="text-danger">{{$message}}</small> @enderror

                            </div>
                           <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-success float-end">Save</button>
                           </div>
                        </div>
                    </form>
                    <p>salek chy</p>
                </div>
            </div>
        </div>
    </div>
@endsection
