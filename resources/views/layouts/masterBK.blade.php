
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
{{--   <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
 --}}  <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
  <link rel="stylesheet" href="{{asset('Ionicons/css/ionicons.min.css')}}">

  @yield('styles')

  </head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" id="app">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <li class="treeview">
            <a href="#"><i class="fa fa-cog"></i> <span>Manage Application</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- @can('isAdmin') --}}
                <li><a href="{{route('posts.index')}}"><i class="fa fa-edit"></i> <span>Post</span></a></li>
                <li><a href="{{route('posts.trashed')}}"><i class="fa fa-trash"></i> <span>Trashed</span></a></li>
                <li><a href="{{route('tags.index')}}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
                <li><a href="{{route('categories.index')}}"><i class="fa fa-edit"></i> <span>Category</span></a></li>
                <li><a href="{{url('gallary')}}"><i class="fa fa-image"></i> <span>Gallary</span></a></li>
               {{--  @endcan --}}
            </ul>
        </li>
        @if(Auth::user()->admin)
        <li class="treeview">
                <a href="#"><i class="fa fa-cog"></i> <span>Management</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                        <li><a href="{{url('users')}}"><i class="fa fa-group"></i> <span>Users</span></a></li>
                        <li><a href="{{url('settings')}}"><i class="fa fa-cog"></i> <span>Site Settings</span></a></li>
                </ul>
        </li>

        @endif
        <li><a href="{{route('user.profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
        <li><a  href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off red"></i> <span>Sign Out</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

        @include('inc.messages')

        @yield('content')

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
</div>

@auth
        <script>
            window.user = @json(auth()->user());
        </script>
@endauth

<script src="js/app.js"></script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="{{asset('js/load.js')}}"></script>

    <script>
       @if(Session::has('success'))
          toastr.success("{{ Session::get('success') }}")
       @elseif(Session::has('info'))
          toastr.info("{{ Session::get('info') }}")
       @endif
    </script>


@yield('scripts')

</body>
</html>
