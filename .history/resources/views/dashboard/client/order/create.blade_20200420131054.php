 @extends('layouts.dashboard.app')
    @section('content')
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark mb-4">@lang('site.orders')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item "> @lang('site.orders')</li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">@lang('site.pos')</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
         @php
        $permisions=['create','read','update','delete'];
        $models=['category','categories','produits','clients','orders'];
        @endphp

        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
             <h3 class="card-title">@lang('site.categories')</h3>
            </div>
            <div class="card-body">
                @foreach ($categories as $category)

                <div class="panel-group">

                    <div class="panel panel-info">

                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                            </h4>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
             <h3 class="card-title">@lang('site.orders')</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                       <thead class="bg-primary">
                    <tr>
                        <th>@lang('site.product')</th>
                        <th>@lang('site.quantity')</th>
                        <th>@lang('site.price')</th>
                    </tr>
                    </thead>

                    <tbody class="order-list">


                    </tbody>

                </table><!-- end of table -->
            </div>
              </div>
              <!-- /.card -->
            </div>
            </div>
            </div>
            </div>
      </div>
    </div>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
        </div>
    </aside>
    @endsection('content')
    @section('scripts')
    <script>
        console.log('hi');
    </script>
    @endsection
