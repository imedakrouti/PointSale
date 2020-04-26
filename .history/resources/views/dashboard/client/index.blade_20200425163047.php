@extends('layouts.dashboard.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="{{asset('adminLte/dist/css/app.css')}}">
<style>
    .testimonial {
  padding: 20px;
  margin-bottom: 40px;
  border-radius: 5px;
  opacity: 0.9;
}
    .testimonial img {
  width: 100px;
  float: left;
  margin-left: 20px;
  border-radius: 50%;
}
.testimonial p {
  margin: 10px 0;
}
</style>
@endsection
@section('content')
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.clients')</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-left">
             <li class="breadcrumb-item active"> @lang('site.clients')</li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">@lang('site.pos')</a></li>

            </ol>
          </div><!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
              <h3 class="card-title mb-2"><i class="fa fa-client"></i> @lang('site.clients')
                @if($clients->total() > 0 )
                <span class="badge badge-info mx-2" >{{$clients->total()}}</span>
                @endif
                @if (auth::user()->hasPermission('create_clients'))
                <a href="{{route('dashboard.client.create')}}" class="btn btn-success float-left  rounded "><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
                @else
                <a href="#" class="btn btn-primary disabled" role="button"><i class="fa fa-plus mx-1"></i>@lang('site.add')</a>
            @endif
              </h3>

                </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <form action="{{ route('dashboard.client.index')}}"method="GET">
                    <div class="row mb-3">
                      <div class="d-flex">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="@lang('site.search')"value="{{request()->table_search}}">
                      </div>
                      <div class="mx-2">
                        <button type='submit'class="btn btn-primary"><i class="fa fa-search mx-1"></i>@lang('site.search')</button>
                      </div>
                    </div>
                    </form>
                 @if ($clients->toatal() > 0)
                 <div class="table-responsive">
                 <table id="example2" class="table table-bordered table-hover">
                    <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.adress')</th>
                                <th>@lang('site.add_order')</th>
                                <th>@lang('site.action')</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1}}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ is_array($client->phone) ? implode('-',$client->phone):$client->phone}}</td>
                                    <td>{{ $client->adress}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('create_orders'))
                                        <a href="{{ route('dashboard.client.order.create',$client->id) }}" class="btn btn-primary">@lang('site.add_order')</a>
                                        @else
                                        <a href="#"class="btn btn-primary disabled">@lang('site.add_order')</a>
                                        @endif
                                    </td>
                                    <td>
                                    @if (auth()->user()->haspermission('update_clients'))
                                       <a href="{{ route('dashboard.client.edit', $client->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                    @else
                                    <button class='btn btn-warning disabled' >@lang('site.update')</button>
                                    @endif
                                           @if(auth::user()->hasPermission('delete_clients'))
                                             <form action="{{ route('dashboard.client.destroy', $client->id) }}" method="post" style="display: inline-block">
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
                            {{-- {{ $clients->appends(request()->query())->links() }} --}}

                        </p>

                        <!-- end of table -->
                    @else
                        <h2>@lang('site.no_data_found')</h2>

                    @endif
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="testimonial">
                <img src="{{auth()->user()->path_image}}"class="float-right">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam eligendi quibusdam, dolorum maxime cum numquam quisquam, deleniti eum incidunt, velit non consectetur. Facere, ipsa maxime, ullam id amet odio laboriosam sit iusto tempore fugit exercitationem, a dolore quo maiores nisi!</p>
              </div>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        console.log('hi');
        $('.datepicker').datepicker();
    </script>
@endsection


