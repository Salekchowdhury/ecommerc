@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Color</h3>
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

                    <form action="{{url('admin/colors/store')}}" method="POST">
                        @csrf
                        <div class="">
                        <div class="mt-3">
                            <div class="mb-3">
                                <label>Color Name</label>
                                <input type="text" name="name" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Code</label>
                                <input type="text" name="code" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status"/>
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
