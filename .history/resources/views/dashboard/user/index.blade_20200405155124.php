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
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
              <h3 class="card-title mb-2"><i class="fa fa-user"></i> @lang('site.users')
                @if($users->total() > 0 )
                <span class="badge badge-info mx-2" >{{$users->total()}}</span>
                @endif
                @if (auth::user()->hasPermission('create_users'))
                <a href="{{route('dashboard.user.create')}}" class="btn btn-success float-left  rounded "><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
                @else
                <a href="#" class="btn btn-primary disabled" role="button"><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
            @endif
              </h3>

                </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <form action="{{ route('dashboard.user.index')}}"method="GET">
                    <div class="row">
                      <div class="">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="@lang('site.search')"value="{{old('table_search')}}">
                      </div>
                      <div class="mx-2">
                        <button type='submit'class="btn btn-primary"><i class="fa fa-search mx-1"></i>@lang('site.search')</button>
                      </div>
                    </div>
                    </form>
                 @if ($users->count() > 0)
                 <div class="table-responsive">
                 <table id="example2" class="table table-bordered table-hover">
                    <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class=""><img src="{{ $user->path_image }}" alt="User Avatar" width="100px"heght="100px" class="mr-3 img-circle">
                                    </td>
                                    <td>
                                    @if (auth()->user()->haspermission('update_users'))
                                       <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @else
                                    <button class='btn btn-warning disabled' >@lang('site.update')</button>
                                    @endif
                                           @if(auth::user()->hasPermission('delete_users'))
                                             <form action="{{ route('dashboard.user.destroy', $user->id) }}" method="post" style="display: inline-block">
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
                            {{ $users->appends(request()->query())->links() }}

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



