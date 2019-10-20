@extends('layouts.masterBK')


@section('content')

<div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Category</a>

        </div>

        <div class="card card-default">
            <div class="card-header">
                Categories
            </div>

            <div class="card-body">
                <table class="table  table-hover table-bordered">
                    <thead>
                        <th>Category name</th>
                        <th>Options</th>
                    </thead>
                    <tbody>
                        <tr>
                        @if($categories->count() > 0)
                        @foreach ($categories as $category)
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">
                                    <span class="fa fa-pencil"></span> Edit
                                </a>

              <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})"><span class="fa fa-trash"></span> Delete </button>


                                {{--<a href="{{ route('categories.destroy', $category->id)}}" class="btn btn-danger btn-sm">
                                    <span class="fa fa-trash"></span> Delete
                                </a>--}}
                            </td>

                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <th colspan="5" class="text-center">No Category Yet</th>
                        </tr>
                        @endif
                    </tbody>
                </table>
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
     form.action = '/admin/categories/' + id
     $('#deleteModel').modal('show')
  }

</script>


@endsection
