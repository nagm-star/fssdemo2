@extends('layouts.masterBK')

@section('content')

<div class="card card-default">

    <div class="card-header">
      {{ isset($user) ? 'Edit user: '  .$user->name : 'Create User' }}
    </div>
    <div class="card-body">
      <div class="col-md-6 float-left">
      <form action="{{ route('user.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
          @csrf

          @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input  type="text" id="name" name="name" class="form-control" value="{{isset($user) ? $user->name : ''}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input  type="email" id="email" name="email" class="form-control" value="{{isset($user) ? $user->email : ''}}">
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>

            <div class="form-group">
                <label for="avatar">Upload new avatar</label>
                <input type="file" id="avatar" name="avatar" class="form-control">
            </div>

            <div class="form-group">
                <label for="facebook">Facebook profile</label>
                <input type="text" id="facebook" name="facebook" class="form-control" value="{{ $user->profile->facebook}}">
            </div>

            <div class="form-group">
                <label for="youtube">Youtube profile</label>
                <input type="text" id="youtube" name="youtube" class="form-control" value="{{ $user->profile->youtube}}">
            </div>


            <div class="form-group">
                <label for="about">About you</label>
                <textarea name="about" id="about" cols="6" rows="6"  class="form-control"> value="{{ $user->profile->about}}"</textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-success">Update profile</button>
            </div>
        </form>
       </div>

       <div class="col-md-6 float-right">
            <div class="col-md-4 float-left">
                <img src="{{ asset($user->profile->avatar)}}" class="img-bordered" style="border:1px solid #ccc" alt="" height="120px" width="120px">
            </div>
            <div class="col-md-8 float-right" style="border:1px solid #ccc; padding:15px;">
                <label for="about"><b>About Me</b></label>
                <p class="float-right">{{ $user->profile->about }}</p> <br>
                <label for="name"><b>Name</b> : {{ $user->name }}</label> <br>
                <label for="email"><b>Email</b> : {{ $user->email }}</label> <br>
                <label for="email"><b>Facebook</b> : {{ $user->profile->facebook }}</label> <br>
                <label for="email"><b>Youtube</b> : {{ $user->profile->youtube }}</label> <br>

            </div>
        </div>

    </div>

</div>

@endsection
