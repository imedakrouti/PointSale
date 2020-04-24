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

<div class="row">

    <div class="col-md-6">

        <div class="box box-primary">

            <div class="box-header">

                <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>

            </div><!-- end of box header -->

            <div class="box-body">

                @foreach ($categories as $category)

                    <div class="card-group">

                        <div class="card card-info">

                            <div class="card-heading">
                                <h4 class="card-title">
                                    <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                </h4>
                            </div>

                            <div id="{{ str_replace(' ', '-', $category->name) }}" class="card-collapse collapse">

                                <div class="card-body">

                                    @if ($category->products->count() > 0)

                                        <table class="table table-hover">
                                            <tr>
                                                <th>@lang('site.name')</th>
                                                <th>@lang('site.stock')</th>
                                                <th>@lang('site.price')</th>
                                                <th>@lang('site.add')</th>
                                            </tr>

                                            @foreach ($category->products as $product)
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>{{ number_format($product->sale_price, 2) }}</td>
                                                    <td>
                                                        <a href=""
                                                           id="product-{{ $product->id }}"
                                                           data-name="{{ $product->name }}"
                                                           data-id="{{ $product->id }}"
                                                           data-price="{{ $product->sale_price }}"
                                                           class="btn btn-success btn-sm add-product-btn">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table><!-- end of table -->

                                    @else
                                        <h5>@lang('site.no_records')</h5>
                                    @endif

                                </div><!-- end of card body -->

                            </div><!-- end of card collapse -->

                        </div><!-- end of card primary -->

                    </div><!-- end of card group -->

                @endforeach

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </div><!-- end of col -->

    <div class="col-md-6">

        <div class="box box-primary">

            <div class="box-header">

                <h3 class="box-title">@lang('site.orders')</h3>

            </div><!-- end of box header -->

            <div class="box-body">

                <form action="{{ route('dashboard.client.order.store', $client->id) }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    @include('partials._errors')

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>@lang('site.product')</th>
                            <th>@lang('site.quantity')</th>
                            <th>@lang('site.price')</th>
                        </tr>
                        </thead>

                        <tbody class="order-list">


                        </tbody>

                    </table><!-- end of table -->

                    <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                    <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.add_order')</button>

                </form>

            </div><!-- end of box body -->

        </div><!-- end of box -->

        {{-- @if ($client->orders->count() > 0)

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')
                        <small>{{ $orders->total() }}</small>
                    </h3>

                </div><!-- end of box header -->

                <div class="box-body">

                    @foreach ($orders as $order)

                        <div class="card-group">

                            <div class="card card-success">

                                <div class="card-heading">
                                    <h4 class="card-title">
                                        <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                    </h4>
                                </div>

                                <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="card-collapse collapse">

                                    <div class="card-body">

                                        <ul class="list-group">
                                            @foreach ($order->products as $product)
                                                <li class="list-group-item">{{ $product->name }}</li>
                                            @endforeach
                                        </ul>

                                    </div><!-- end of card body -->

                                </div><!-- end of card collapse -->

                            </div><!-- end of card primary -->

                        </div><!-- end of card group -->

                    @endforeach

                    {{ $orders->links() }}

                </div><!-- end of box body -->

            </div><!-- end of box -->

        @endif --}}

    </div><!-- end of col -->

</div><!-- end of row -->
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
    <script src="{{ asset('adminLte/dist/js/order.js') }}"></script>
    <script>
        console.log('hi');
    </script>
    @endsection
