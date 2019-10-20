@extends('layouts.masterBK')


@section('content')

<div class="">
     <!-- Content Wrapper. Contains page content -->
  <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{$post_count}} </h3>

                  <p>Published Posts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('posts.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3> {{$trashed_count}}  </h3>

                    <p>Tashed Posts</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{route('posts.trashed')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>{{$users_count}} </h3>

                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('users')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>

                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->

          <!-- /.row (main row) -->

      <!-- /.content-wrapper -->
      <div class="">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Latest Posts</h3>
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
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{!!  substr(strip_tags($post->title), 0, 30) !!}</td>
                                        <td>{!!  substr(strip_tags($post->content), 0, 40) !!}</td>
                                        <td><img src="{{ $post->featured }}" alt="{{ $post->title }}" height="50px" width="90px"  ></td>
                                        <td>{{$post->created_at->toFormattedDateString()}}</td>
                                        <td>{{ $post->category->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
</div>
</div>


@endsection
