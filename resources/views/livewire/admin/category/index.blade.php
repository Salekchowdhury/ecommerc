
<div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent ='destroyCategory' >
                <div class="modal-body">
                    <h6>Are you sure you want to delete this data?</h6>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" data-bs-dismiss="modal"  class="btn btn-primary">Yes. Delete</button>
                  </div>
            </form>
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Category</h3>
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <a href="{{route('admin.category.create')}}" class="btn btn-sm btn-success float-end">Add Category</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                       <thead>
                         <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                         </tr>
                       </thead>
                        <tbody>
                            @foreach ($categories as $list)
                            <tr>
                                <td>{{$list->id}}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->status == '1'? 'Hidden': 'Visible'}}</td>
                                <td>
                                    <a href="{{url('admin/category/'.$list->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="#" wire:click="deleteCategory({{$list->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


