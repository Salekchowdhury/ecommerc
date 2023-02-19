<div>
@include('livewire.admin.brand.modal-form')
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if (Session::has('message'))
                    <div class="row">
                       <div class="col-md-6">
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                       </div>
                       <div class="col-md-6">

                       </div>
                    </div>
                @endif
                <h4>
                    <p>Brand List</p>
                    <a href="" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addBrandModal">Add Brand</a>
                </h4>

            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ( $brands as $list )
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->slug}}</td>
                        <td>{{$list->status == '1'? 'Hidden': 'Visible'}}</td>
                        <td>
                            <a href="#" wire:click= 'editBrand({{$list->id}})'  class='btn btn-sm btn-success' data-bs-toggle="modal" data-bs-target="#updateBrandModal">Edit</a>
                            <a href="#" wire:click= 'deleteBrand({{$list->id}})' class='btn btn-sm btn-danger' data-bs-toggle="modal" data-bs-target="#deleteBrandModal">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <td colspan="5"> No Brand Found</td>
                    @endforelse
                </tbody>
                </table>
                {{$brands->links()}}
            </div>
        </div>
    </div>
   </div>
</div>
