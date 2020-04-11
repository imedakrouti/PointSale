@extends('layouts.dashboard.app')
@section('content')
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.dashboard')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item active"> @lang('site.dashboard')</li>
              <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"> @lang('site.pos') </a></li>

            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
        <section class="content">

        </section>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
@endsection
