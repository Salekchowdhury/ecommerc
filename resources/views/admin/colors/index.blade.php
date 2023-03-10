@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Color</h3>
                    <a href="{{url('admin/colors/create')}}" class="btn btn-sm btn-success float-end">Add Color</a>
                </div>
                <div class="card-body">
                    <table class="table table-border table-striped">
                       <thead>
                        <tr>
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                       </thead>
                       <tbody>
                        @forelse ($colors as $color )
                        <tr>
                            <td>{{$color->id}}</td>
                            <td>{{$color->name}}</td>
                            <td>{{$color->code}}</td>
                            <td>{{$color->status? 'Hidden': 'Visible'}}</td>
                            <td>
                                <a href="{{url('admin/colors/'.$color->id.'/edit')}}" class='btn btn-sm btn-success'>Edit</a>
                                <a href="{{url('admin/colors/'.$color->id.'/delete')}}" class='btn btn-sm btn-danger'>Delete</a>
                            </td>
                        </tr>
                        @empty
                            No Color Found.
                        @endforelse
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
