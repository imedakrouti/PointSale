 @extends('layouts.dashboard.app')
    @section('content')
    @section('styles')
<link rel="stylesheet" href="{{asset('adminLte/dist/css/app.css')}}">
@endsection
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.product')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item active"> @lang('site.products')</li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">@lang('site.pos')</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
         @php
        $permisions=['create','read','update','delete'];
        $models=['clients','categories','produits'];
        @endphp
        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
        <div class="card card-success">
            <div class="card-header">
             <h3 class="card-title">@lang('site.add')</h3>
            </div>
            <div class="card-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group">
                         <label for="category">@lang('site.categories')</label>
                         <select name="category_id" class="form-control">
                            <option value="">@lang('site.all_categories')</option>
                             @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                             @endforeach
                         </select>
                     </div>
                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' .$locale. '.name')</label>
                        <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{old($locale .'.name')  }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.' .$locale. '.description')</label>
                        <textarea name="{{ $locale }}[description]" class="form-control">{{old($locale .'.description')}}</textarea>
                    </div>
                    @endforeach
                     <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                     <div class="form-group">
                        <label>@lang('site.purchase_price')</label>
                        <input type="number" name="purchase_price" class="form-control"value={{ old('purchase_price') }}step="0.1" min=0>
                    </div>
                     <div class="form-group">
                        <label>@lang('site.sale_price')</label>
                        <input type="number" name="sale_price" class="form-control"value={{ old('sale_price') }}step=0.1 min=0>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock" class="form-control"value={{ old('stock') }}step=0.1 min=0>
                    </div>
                    </div>  <!-- /.card-body -->
                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
                </form><!-- end of form -->
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
