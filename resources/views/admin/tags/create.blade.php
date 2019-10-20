@extends('layouts.masterBK')


@section('content')

<div class="card card-default">

    <div class="card-header">
      {{ isset($tag) ? 'Edit tag: '  .$tag->name : 'Create Tag' }}
    </div>
    <div class="card-body">

{{--       @include('partials.errors')
 --}}
      <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="post">
          @csrf

          @if(isset($tag))
          @method('PUT')
          @endif

            <div class="form-group">
                <label for="tag">Name</label>
                <input type="text" id="tag" name="tag" class="form-control" value="{{isset($tag) ? $tag->tag : ''}}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">{{ isset($tag) ? 'Update Tag' : 'Add Tag'}}</button>
            </div>
        </form>
    </div>

</div>

@endsection
