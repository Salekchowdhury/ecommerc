@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Color</h3>
                    <a href="{{url('admin/colors')}}" class="btn btn-sm btn-primary float-end">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                    @foreach ($errors->all() as $error )
                        <div>{{$error}}</div>
                    @endforeach
                        </div>
                    @endif

                    <form action="{{url('admin/colors/'.$color->id.'/update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="">
                        <div class="mt-3">
                            <div class="mb-3">
                                <label>Color Name</label>
                                <input type="text" value="{{$color->name}}" name="name" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Code</label>
                                <input type="text" value="{{$color->code}}" name="code" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <input type="checkbox" {{$color->status == true ? 'checked':''}}  name="status"/>
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
