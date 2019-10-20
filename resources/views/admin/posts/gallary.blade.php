@extends('layouts.masterBK')


@section('content')

<div class="">
<div class="row">
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="padding:15px 0 7px 0 !important">
                <h1>
                    Banners Area
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Banners</li>
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
                            <th>title</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th>Modify</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($gallaries as $gallar)
                            <tr>
                                <td>{!!str_limit($gallar->title,30,'...')!!}</td>
                                <td>{!!str_limit($gallar->body,50,'...')!!}</td>
                                <td><img src="<?php echo asset("storage/img/$gallar->image") ?>" height="60px" width="60px"  ></td>
                                <td>{{$gallar->created_at->format('Y-m-d')}}</td>
                                <td>{{$gallar->status}}</td>
                                <td>

                                <button class="" data-mytitle="{{$gallar->title}}" data-gallarid="{{$gallar->id}}" data-mybody="{{$gallar->body}}" data-mystatus="{{$gallar->status}}" data-toggle="modal" data-target="#EditGallary">
                                        <i class="fa fa-edit blue"></i>
                                </button>

                                <button class=""  data-gallarid="{{$gallar->id}}"  data-toggle="modal" data-target="#DeleteGallary">
                                        <i class="fa fa-trash red"></i>
                                </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                        <div class="col-md-8">  {{$gallaries->links()}} </div>
                    </div>
                </div>
        </div>
    </div>
</div>



            <!-- Add New Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="width:730px; margin-right:150px; padding:6px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('gallary.store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-body">
                                <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                    <div class="form-group">
                                            <label for="title">Description</label>
                                            <textarea  name="body" class="form-control" id="bod" cols="20" rows="5">
                                            </textarea>
                                    </div>
                                    <div class="form-group">
                                            <div class="custom-file col-md-6">
                                            <label for="title">Upload Image</label>
                                                <input type="file"  name="image" id="image" class="form-control-file">
                                                <p id="emailHelp" class="form-text red">(.jpg/.png/.jpeg/ file only and Max file Size 1 MB Recommended Image 600 X 455 Px)</p>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <select name="status" id="status" class="form-control col-md-4">
                                            <option value="">Select status</option>
                                            <option value="Publish">Publish</option>
                                            <option value="UnPublish">UnPublish</option>
                                        </select>
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
            <div class="modal fade" id="EditGallary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="width:730px; margin-right:150px; padding:6px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Gallary</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('gallary.update','test')}}" method="POST"  enctype="multipart/form-data">
                            {{method_field('patch')}}
                            {{ csrf_field() }}
                        <div class="modal-body">
                                <input type="hidden" name="gallar_id" id="gallary_id" value="">
                                <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                    <div class="form-group">
                                            <label for="title">Description</label>
                                            <textarea  name="body" class="form-control" id="bod" cols="20" rows="5">
                                            </textarea>
                                    </div>
                                    <div class="form-group">
                                            <div class="custom-file col-md-6">
                                            <label for="title">Upload Image</label>
                                                <input type="file"  name="image" id="image" class="form-control-file">
                                                <p id="emailHelp" class="form-text red">(.jpg/.png/.jpeg/ file only and Max file Size 1 MB Recommended Image 600 X 455 Px)</p>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <select name="status" id="status" class="form-control col-md-4">
                                            <option value="">Select status</option>
                                            <option value="Publish">Publish</option>
                                            <option value="UnPublish">UnPublish</option>
                                        </select>
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
            <div class="modal fade modal-danger" id="DeleteGallary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('gallary.destroy','test')}}" method="POST">
                            {{method_field('delete')}}
                            {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                                Are you sure you want to delete this?
                            </p>
                                <input type="hidden" name="gallar_id" id="gallary_id" value="">
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
