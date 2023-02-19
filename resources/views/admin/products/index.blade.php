@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Product</h3>
                    <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-success float-end">Add Product</a>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @forelse ($products as $product )
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                    @if ($product->category)
                                    @else
                                        No Category
                                    @endif
                                    {{$product->category->name}}
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status == '1'? 'Hidden': 'visible'}}</td>
                                <td>
                                    <a href="{{ url('admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{url('admin/product/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure delete this product?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>

                            </tr>
                            @empty
                                <td colspan="7">No Products Availabe</td>
                            @endforelse

                        </tbody>
                    </thead>
                  </table>
                  <div>{{$products->links()}}</div>
                </div>
            </div>
        </div>
    </div>

    @endsection
