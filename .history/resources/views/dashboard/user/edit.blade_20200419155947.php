 @extends('layouts.dashboard.app')
    @section('content')
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.users')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item active"> @lang('site.users')</li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">@lang('site.pos')</a></li>
            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
         @php
        $permisions=['create','read','update','delete'];
        $models=['users','categories','produits'];
        @endphp

        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
        <div class="card card-success card-outline">
            <div class="card-header">
             <h3 class="card-title"><i class="fa fa-edit"></i>@lang('site.edit')</h3>
            </div>
            <div class="card-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('Put')
                    <div class="form-group">
                        <label>@lang('site.first_name')</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.last_name')</label>
                    </div>
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">

                    <div class="form-group">
                        <label>@lang('site.email')</label>
                    </div>
                        <input type="email" name="email" class="form-control" value="{{ $user->email}}">
                    <div class="d-flex ">
                    <div class="form-group col-md-8">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                     <div class="form-group text-center mt-4 col-md-4">
                      <img src="{{ $user->path_image }}"  style="width: 100px" class="img-thumbnail image-preview rounded" alt="">
                    </div>
                    </div>
                     <!-- checkbox -->
                {{-- <div class="form-group">
                    <label class="d-block">@lang('site.permissions')</label>
                    @foreach ($permisions as $permission )
                          <label>@lang('site.'.$permission)
                        <input type="checkbox" name="permissions[]" {{ $user->hasPermission($permission .'_users') ? 'checked' :'' }} value="{{$permission}}_users"class="flat-red">
                    </label>
                    @endforeach --}}
                    <div class="form-group">
                        <label>@lang('site.permissions')</label>
                        <div class="nav-tabs-custom">

                            @php
                                $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                $permissions = ['create', 'read', 'update', 'delete'];
                            @endphp

                            <ul class="nav nav-tabs "id="custom-tabs-two-tab">
                                @foreach ($models as $index=>$model)
                                    <li class="nav-item {{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                @endforeach
                            </ul>

                            {{-- <div class="tab-content">

                                @foreach ($models as $index=>$model)

                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                        @foreach ($permissions as $permission)
                                        <label><input type="checkbox" name="permissions[]" {{ $user->hasPermission($permission . '_' . $model) ? 'checked' : '' }} value="{{ $permission . '_' . $model }}"> @lang('site.' . $permission)</label>
                                        @endforeach

                                    </div>

                                @endforeach

                            </div><!-- end of tab content --> --}}

                        </div><!-- end of nav tabs -->

                    </div>
                    {{-- <label>@lang('site.create')
                        <input type="checkbox" name="permissions[]" value="create_users"class="flat-red" checked>
                    </label>
                    <label>@lang('site.read')
                        <input type="checkbox" name="permissions[]"value="read_users"class="flat-red" >
                    </label>
                    <label>@lang('site.edit')
                      <input type="checkbox" name="permissions[]"value="update_users"class="flat-red">
                    </label>
                    <label>@lang('site.delete')
                      <input type="checkbox" name="permissions[]"value="delete_users"class="flat-red" >
                    </label> --}}
                  </div>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> @lang('site.edit')</button>
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
         $(document).ready(function () {


        $(".image").change(function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

    });//end of ready

    </script>
@endsection
