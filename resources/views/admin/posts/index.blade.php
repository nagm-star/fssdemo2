@extends('layouts.masterBK')


@section('content')
<div class="row">
        <div class="col-md-12">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="padding:15px 0 7px 0 !important">
                    <ol class="breadcrumb">
                        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">News</li>
                    </ol>
            </section>
        </div>
    </div>

<div class="">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <span class="float-right">
        <a href="{{ route('posts.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Posts</a>

            </span>
        </div>
        <div class="box-body">


            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>Content</th>
                        <th>Photo</th>
                        <th>Created at</th>
                        <th>Category</th>
                        <th>Modify</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <tr>
                                <td>{!!  substr(strip_tags($post->title), 0, 30) !!}</td>
                                <td>{!!  substr(strip_tags($post->content), 0, 40) !!}</td>
                                <td><img src="{{ $post->featured }}" alt="{{ $post->title }}" height="50px" width="90px"  ></td>
                                <td>{{$post->created_at->toFormattedDateString()}}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                <a href="{{ route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">
                                    <span class="fa fa-pencil"></span> Edit
                                </a>
                                 <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $post->id }})"><span class="fa fa-trash"></span> Trash </button>

                                </td>
                            </tr>
                        @endforeach


                        @else
                        <tr >
                            <th colspan="6" class="text-center">No post yet</th>
                        </tr>
                    @endif
            </tbody>
        </table>

        <div class="row">
                <div class="col-md-8">  {{$posts->links()}} </div>
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
            Are you sure you want to trash this?
          </p>
          <input type="hidden" name="prod_id" id="product_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Trash</button>
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
     form.action = '/admin/posts/' + id
     $('#deleteModel').modal('show')
  }

</script>


@endsection
