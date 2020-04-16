 @extends('layouts.dashboard.app')
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
         @php
        $permisions=['create','read','update','delete'];
        $models=['products','products','produits'];
        @endphp

        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
        <div class="card card-success">
            <div class="card-header">
             <h3 class="card-title">@lang('site.add')</h3>
            </div>
            <div class="card-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.product.update',$product->id) }}" method="post">
                    @method('put')
                    @csrf
                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label>@lang('site.' .$locale. '.name')</label>
                        <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{$product->translate($locale)->name }}">
                    </div>
                    @endforeach
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
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
