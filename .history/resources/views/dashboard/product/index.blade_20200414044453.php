@extends('layouts.dashboard.app')
@section('styles')
<link rel="stylesheet" href="{{asset('adminLte/dist/css/app.css')}}">
@endsection
@section('content')
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.products')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item active"> @lang('site.products')</li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">@lang('site.pos')</a></li>

            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
              <h3 class="card-title mb-2"><i class="fa fa-product"></i> @lang('site.products')

                <span class="badge badge-info mx-2" >{{ $products->count()>0 ? $products->count():''}}</span>
                @if (auth::user()->hasPermission('create_products'))
                <a href="{{route('dashboard.product.create')}}" class="btn btn-success float-left  rounded "><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
                @else
                <a href="#" class="btn btn-primary disabled" role="button"><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
            @endif
              </h3>

                </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <form action="{{ route('dashboard.product.index')}}"method="GET">
                    <div class="row">
                      <div class="">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="@lang('site.search')"value="{{request()->table_search}}">
                      </div>
                          <div class="form-group mx-2">
                              <select id="category_id" class="custom-select form-control" name="category_id">
                                  <option value="">@lang('site.all_categories')</option>
                                  @foreach($categories as $category)
                                  <option value='{{ $category->id }}' {{ request()->category_id== $category->id ? 'selected' :'' }}>{{ $category->name }}</option>
                                  @endforeach
                              </select>
                      </div>
                      <div class="mx-2">
                        <button type='submit'class="btn btn-primary"><i class="fa fa-search mx-1"></i>@lang('site.search')</button>
                      </div>
                    </div>
                    </form>
                 @if ($products->count() > 0)
                 <div class="table-responsive">
                 <table id="example2" class="table table-bordered table-hover">
                    <thead class="bg-primary">
                            <tr>
                                <th>#</th>

                                <th>@lang('site.name')</th>
                                <th>@lang('site.categories')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.action')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td><img class="img-circle zoom"src="{{ $product->image_path }}" alt=""></td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                    @if (auth()->user()->haspermission('update_products'))
                                       <a href="{{ route('dashboard.product.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @else
                                    <button class='btn btn-warning disabled' >@lang('site.update')</button>
                                    @endif
                                           @if(auth::user()->hasPermission('delete_products'))
                                             <form action="{{ route('dashboard.product.destroy', $product->id) }}" method="post" style="display: inline-block">
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
                            {{ $products->appends(request()->query())->links() }}

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
    <script>
        console.log('hi');
    </script>



