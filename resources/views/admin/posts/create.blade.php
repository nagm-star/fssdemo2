@extends('layouts.masterBK')



@section('content')

   <div class="card card-default">

    <div class="card card-header">
         {{ isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>

    <div class="card-body">

        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          @if(isset($post))
          @method('PUT')
          @endif

          <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{isset($post) ? $post->title : ''}}">
          </div>

          @if (isset($post))
          <div class="form-group">
                <img src="{{ $post->featured }}" alt="{{ $post->title }}" height="60px" width="120px"  >
          </div>

          @endif


          <div class="form-group">
                <label for="featured">Featured Image</label>
                <input type="file" class="form-control" name="featured" id="image">
          </div>

          <div class="form-group">
                <label for="category">Category </label>
                <select name="category_id" id="category" class="form-control">
                  @foreach($categories as $category)
                      <option value="{{ $category->id }}"
                            @if(isset($post))
                                @if($post->category->id == $category->id)
                                    selected
                                @endif
                            @endif
                        >{{ $category->name }}</option>
                  @endforeach
                </select>
          </div>

          <div class="form-group">
              <label for="tags"> Select tags</label>
              @foreach ($tags as $tag)
                <div class="checkbox">
                        <label><input type="checkbox" value="{{ $tag->id }}" name="tags[]" id=""
                            @if(isset($post))
                                @foreach($post->tags as $t)
                                    @if($tag->id == $t->id)
                                        checked
                                    @endif
                                @endforeach
                            @endif

                            > {{ $tag->tag }}
                        </label>
                </div>
               @endforeach
          </div>

          <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="content" cols="30"  rows="10" >{{isset($post) ? $post->content : ''}}</textarea>
          </div>



          <div class="form-group text-center">
              <button type="submit" class="btn btn-success">
                    {{ isset($post) ? 'Update Post' : 'Save Post' }}
              </button>
          </div>


        </form>
    </div>

   </div>

@endsection

@section('styles')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

@stop

@section('scripts')

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script>
    $(document).ready(function() {
        $('#content').summernote();
    });
</script>

@stop
