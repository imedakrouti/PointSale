@extends('layouts.dashboard.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" />
<link rel="stylesheet" href="{{asset('adminLte/dist/css/app.css')}}">
@endsection
@section('content')
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.categories')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item active"> @lang('site.categories')</li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">@lang('site.pos')</a></li>

            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
              <h3 class="card-title mb-2"><i class="fa fa-category"></i> @lang('site.categories')
                @if($categories->total() > 0 )
                <span class="badge badge-info mx-2" >{{$categories->total()}}</span>
                @endif
                @if (auth::user()->hasPermission('create_categories'))
                <a href="{{route('dashboard.category.create')}}" class="btn btn-success float-left  rounded "><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
                @else
                <a href="#" class="btn btn-primary disabled" role="button"><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
            @endif
              </h3>

                </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <form action="{{ route('dashboard.category.index')}}"method="GET">
                    <div class="row mb-3">
                      <div class="d-flex">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="@lang('site.search')"value="{{old('table_search')}}">
                      <input type="date" name="date" class="form-control float-right mx-2" placeholder="@lang('site.search')"value="{{old('date')}}">
                      </div>
                      <div class="mx-2">
                        <button type='submit'class="btn btn-primary"><i class="fa fa-search mx-1"></i>@lang('site.search')</button>
                      </div>
                    </div>
                    </form>
                 @if ($categories->count() > 0)
                 <div class="table-responsive">
                 <table id="example2" class="table table-bordered table-hover">
                    <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.products_count')</th>
                                <th>@lang('site.related_products')</th>
                                <th>@lang('site.action')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($categories as $index=>$category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products->count()}}</td>
                                    @if($category->products->count()>0)
                                    <td><a href="{{ route('dashboard.product.index',['category_id'=>$category->id]) }}"class="btn btn-outline-warning">@lang('site.show_products')</a></td>
                                    @else
                                    <td><a href="{{ route('dashboard.product.index',['category_id'=>$category->id]) }}"class="btn btn-outline-warning disabled">@lang('site.show_products')</a></td>
                                    @endif
                                    <td>
                                    @if (auth()->user()->haspermission('update_categories'))
                                       <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @else
                                    <button class='btn btn-warning disabled' >@lang('site.update')</button>
                                    @endif
                                           @if(auth::user()->hasPermission('delete_categories'))
                                             <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                              @else
                                    <button class='btn btn-danger disabled' ><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                           @endif

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                 </div>
                        <p>
                            {{ $categories->appends(request()->query())->links() }}

                        </p>

                        <!-- end of table -->
                    @else
                        <h2>@lang('site.no_data_found')</h2>

                    @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      <!-- Control Sidebar -->


        <!-- Main content -->
    </div>
    @endsection('content')
    @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>    <script>
        console.log('hi');
        $('[data-toggle="datepicker"]').datepicker();
    </script>
@endsection


