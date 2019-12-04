@extends('layouts.app')

@inject('model','App\Order')
@push('title')
    {{trans('admin.new_order')}}
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.new_order')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.new_order')}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-md-6">

                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title" style="margin-bottom: 10px">{{trans('admin.categories')}}</h3>

                    </div><!-- end of box header -->

                    <div class="box-body">

                        @foreach ($categories as $category)

                            <div class="panel-group">

                                <div class="panel panel-info">

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                        </h4>
                                    </div>

                                    <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                        <div class="panel-body">

                                            @if ($category->products->count() > 0)

                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>{{trans('admin.name')}}</th>
                                                        <th>{{trans('admin.stock')}}</th>
                                                        <th>{{trans('admin.price')}}</th>
                                                        <th>{{trans('admin.add')}}</th>
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
                                                                   class="btn {{in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled':'btn-success add-product-btn'}} btn-sm">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </table><!-- end of table -->

                                            @else
                                                <h5>{{trans('admin.no_data')}}</h5>
                                            @endif

                                        </div><!-- end of panel body -->

                                    </div><!-- end of panel collapse -->

                                </div><!-- end of panel primary -->

                            </div><!-- end of panel group -->

                        @endforeach

                    </div><!-- end of box body -->

                </div><!-- end of box -->

            </div><!-- end of col -->

            <div class="col-md-6">

                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title">{{trans('admin.orders')}}</h3>

                    </div><!-- end of box header -->

                    <div class="box-body">

                        {!!Form::open([
                            'action' => ['admin\OrderController@UpdateOrder',$order->id],
                            'method' => 'put'
                        ])!!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{trans('admin.product')}}</th>
                                <th>{{trans('admin.quantity')}}</th>
                                <th>{{trans('admin.price')}}</th>
                                <th>{{trans('admin.delete')}}</th>
                            </tr>
                            </thead>

                            <tbody class="order-list">
                                @foreach($order->products as $product)
                                    <tr>
                                        <input type="hidden" name="products[]" value="{{$product->id}}">
                                        <td>{{$product->name}}</td>
                                        <td><input type="number" name="quantities[]" data-price="{{ number_format($product->sale_price, 2) }}" class="form-control input-sm product-quantity" min="1" value="{{$product->pivot->quantity}}"></td>
                                        <td class="product-price">{{number_format($product->sale_price * $product->pivot->quantity)}}</td>
                                        <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="{{$product->id}}"><span class="fa fa-trash"></span></button></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        <h4>{{trans('admin.total')}} : <span class="total-price">{{ number_format($order->total_price, 2) }}</span></h4>

                        <button class="btn btn-primary btn-block" id="form-btn"><i class="fa fa-edit"></i>{{trans('admin.edit_order')}}</button>

                        {!!Form::close()!!}

                    </div><!-- end of box body -->

                </div><!-- end of box -->

            </div><!-- end of col -->

        </div><!-- end of row -->

    </section>
    <!-- /.content -->
@endsection
