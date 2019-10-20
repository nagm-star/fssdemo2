@extends('layouts.masterBK')


@section('content')
<div class="row">
        <div class="col-md-12">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="padding:15px 0 7px 0 !important">
                    <ol class="breadcrumb">
                        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                    </ol>
            </section>
        </div>
    </div>

<div class="">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <span class="float-right">
        <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add user</a>

            </span>
        </div>
        <div class="box-body">


            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Permissions</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ asset($user->profile->avatar)}}" alt="" height="50px" width="50px"  srcset="">
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    @if(Auth::id() !== $user->id)
                                        @if($user->admin)
                                            <a href="{{ route('users.not_admin', $user->id) }}" class="btn btn-sm btn-danger">Remove Permissions</a>
                                        @else
                                            <a href="{{ route('users.admin', $user->id) }}" class="btn btn-sm btn-success">Make admin</a>
                                        @endif
                                        @else
                                        Super Admin
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::id() !== $user->id)
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $user->id }})"><span class="fa fa-trash"></span> Delete </button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach


                        @else
                        <tr >
                            <th colspan="6" class="text-center">No users</th>
                        </tr>
                    @endif
            </tbody>
        </table>

        <div class="row">
                <div class="col-md-8"> {{--  {{$users->links()}} --}} </div>
            </div>
        </div>
    </div>
</div>

            <!-- View Modal -->
            <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="width:930px; margin-right:150px; padding:6px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Post Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card invoice" style="width: 850px;">
                        <div class="card-body" style="border:none !important;">
                                <form action="{{route('posts.show','test')}}" method="POST">
                                        {{method_field('patch')}}
                                        {{ csrf_field() }}
                                    <div class="modal-body">
                                            <input type="hidden" name="category_id" id="cat_id" value="">
                                            <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" style="border-style: none" readonly name="title" value="" class="form-control" id="title">
                                                </div>
                                                <div class="form-group">
                                                        <label for="title">Description</label>
                                                        <textarea  readonly name="description" style="border-style: none"  class="form-control" id="des" cols="20" rows="5">
                                                        </textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label for="title">Status</label>
                                                        <select name="status" id="status"  style="border-style: none" disabled class="form-control col-md-4">
                                                            <option value="">Select status</option>
                                                            <option value="Publish">Publish</option>
                                                            <option value="UnPublish">UnPublish</option>
                                                        </select>
                                                </div>
                                    </div>
                                </form>
                        </div>
                        </div>

                        </div>
                    </div>
                    </div>

<!-- Delete Modal -->
<div class="modal fade modal-danger" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="deleteCategoryForm">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p class="text-center">
            Are you sure you want to delete this?
          </p>
          <input type="hidden" name="prod_id" id="product_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection



@section('scripts')

<script>

  function handleDelete(id) {
      //console.log('star.', id)
     var form = document.getElementById('deleteCategoryForm')
     form.action = '/user/delete/' + id
     $('#deleteModel').modal('show')
  }

</script>


@endsection
