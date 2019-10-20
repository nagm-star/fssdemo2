@extends('layouts.masterBK')

@section('content')

<div class="card card-default">

    <div class="card-header">
            Update user profile
    </div>
    <div class="card-body">

      <form action="{{ route('users.store') }}" method="POST">
          @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input required type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Add user</button>
            </div>
        </form>
    </div>

</div>

@endsection
