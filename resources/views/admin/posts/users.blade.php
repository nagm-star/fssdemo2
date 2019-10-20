@extends('layouts.masterBK')


@section('content')

<div class="">
        <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (Page header) -->
                    <section class="content-header" style="padding:15px 0 7px 0 !important">
                            <h1>
                                Users Area
                                <small></small>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                                <li class="active">Users</li>
                            </ol>
                    </section>
                </div>
        </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <span class="float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Add New <i class="fa fa-plus"></i>
                    </button>
            </span>
        </div>
        <div class="box-body">

            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Registered At</th>
                            <th>Modify</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{!!str_limit($user->name,30,'...')!!}</td>
                                <td>{!!str_limit($user->email,50,'...')!!}</td>
                                <td>{{$user->type}}</td>
                                <td>{{$user->created_at->format('Y-m-d')}}</td>
                                <td>

                                <button class="" data-myname="{{$user->name}}" data-userid="{{$user->id}}" data-myemail="{{$user->email}}"
                                        data-mytype="{{$user->type}}" data-mypassword="{{$user->password}}" data-toggle="modal" data-target="#EditUser">
                                        <i class="fa fa-edit blue"></i>
                                </button>

                                <button class=""  data-userid="{{$user->id}}"  data-toggle="modal" data-target="#DeleteUser">
                                        <i class="fa fa-trash red"></i>
                                </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                        <div class="col-md-8">  {{$users->links()}} </div>
                    </div>
                </div>
        </div>
    </div>
</div>



            <!-- Add New Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email Address"  class="form-control" >
                                </div>

                                <div class="form-group">
                                    <select name="type"id="type" class="form-control">
                                        <option value="">Select User Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">Standard User</option>
                                        <option value="author">Author</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" placeholder="Password"  class="form-control">
                                </div>
                        </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                    </form>

                        </div>
                    </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('users.update','test')}}" method="POST"  enctype="multipart/form-data">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                        <div class="modal-body">
                                <input type="hidden" name="user_id" id="us_id" value="">
                                <div class="form-group">
                                        <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" placeholder="Email Address"  class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">Select User Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">Standard User</option>
                                            <option value="author">Author</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" placeholder="Password"  class="form-control">
                                    </div>
                        </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                    </form>

                        </div>
                    </div>
            </div>


            <!-- Delete Modal -->
            <div class="modal fade modal-danger" id="DeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('users.destroy','test')}}" method="POST">
                            {{method_field('delete')}}
                            {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                                Are you sure you want to delete this?
                            </p>
                                <input type="hidden" name="user_id" id="us_id" value="">
                        </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                            </div>
                    </form>

                        </div>
                    </div>
            </div>


@endsection
