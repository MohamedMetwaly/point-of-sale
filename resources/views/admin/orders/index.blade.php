@extends('layouts.app')

@push('title')
    {{trans('admin.orders')}}
@endpush

@section('content')



        <section class="content-header">

            <h1>{{trans('admin.orders')}}
                <small>{{ $orders->count() }} {{trans('admin.orders')}}</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> {{trans('admin.dashboard')}}</a></li>
                <li class="active">{{trans('admin.orders')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">{{trans('admin.orders')}}</h3>

                            <form action="" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control" placeholder="{{trans('admin.search')}}" value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{trans('admin.search')}}</button>
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($orders->count() > 0)

                            <div class="box-body table-responsive">

                                <table class="table table-hover">
                                    <tr>
                                        <th>{{trans('admin.client_name')}}</th>
                                        <th>{{trans('admin.price')}}</th>
                                        <th>{{trans('admin.created_at')}}</th>
                                        <th class="text-center">{{trans('admin.show')}}</th>
                                        <th class="text-center">{{trans('admin.edit')}}</th>
                                        <th class="text-center">{{trans('admin.delete')}}</th>
                                    </tr>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ optional($order->client)->name }}</td>
                                            <td>{{ number_format($order->total_price, 2) }}</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-sm order-products"
                                                        data-url="{{ route('show-products', $order->id) }}"
                                                        data-method="get"
                                                >
                                                    <i class="fa fa-list"></i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('order.edit',$order->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <td class="text-center">
                                                {!! Form::open([
                                                    'action' => ['admin\OrderController@destroy',$order->id],
                                                    'method' => 'delete'
                                                ]) !!}
                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                                                {!! Form::close() !!}
                                            </td>

                                        </tr>

                                    @endforeach

                                </table><!-- end of table -->

                                {{ $orders->appends(request()->query())->links() }}

                            </div>

                        @else

                            <div class="box-body">
                                <h3>{{trans('admin.no_data')}}</h3>
                            </div>

                        @endif

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-4">

                    <div class="box box-primary">

                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">{{trans('admin.show_products')}}</h3>
                        </div><!-- end of box header -->

                        <div class="box-body">

                            <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                <div class="loader"></div>
                                <p style="margin-top: 10px">{{trans('admin.loading')}}</p>
                            </div>

                            <div id="order-product-list">

                            </div><!-- end of order product list -->

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content section -->


@endsection
