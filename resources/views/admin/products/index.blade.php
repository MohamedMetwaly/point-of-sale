@extends('layouts.app')

@push('title')
    {{trans('admin.products')}}
@endpush

@section('content')

    <section class="content-header">
        <h1>
            {{trans('admin.products')}}<small>{{$records->count()}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.products')}}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
                {!! Form::open([
                    'action' => 'admin\ProductController@index',
                    'method' => 'get'
                ]) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="{{trans('admin.search')}}">
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-control">
                                <option>{{trans('admin.all_categories')}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{request()->category_id ==$category->id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>{{trans('admin.search')}}</button>
                            <a href="{{url(route('product.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.description')}}</th>
                                <th>{{trans('admin.category')}}</th>
                                <th>{{trans('admin.image')}}</th>
                                <th>{{trans('admin.purchase_price')}}</th>
                                <th>{{trans('admin.sale_price')}}</th>
                                <th>{{trans('admin.profit_percent')}}</th>
                                <th>{{trans('admin.stock')}}</th>
                                <th class="text-center">{{trans('admin.edit')}}</th>
                                <th class="text-center">{{trans('admin.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->description}}</td>
                                    <td>{{optional($record->category)->name}}</td>
                                    <td>
                                        @if($record->image != null)
                                            <img src="{{asset($record->image)}}" width="100px" class="thumbnail image_preview">
                                        @else
                                            <img src="{{asset('uploads/basket.png')}}" width="100px" class="thumbnail image_preview">
                                        @endif
                                    </td>
                                    <td>{{$record->purchase_price}}</td>
                                    <td>{{$record->sale_price}}</td>
                                    <td>{{$record->profit_percent}}</td>
                                    <td>{{$record->stock}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('product.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['admin\ProductController@destroy',$record->id],
                                            'method' => 'delete'
                                        ]) !!}
                                        <button type="Submit" class="btn btn-danger delete btn-xs"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        {{$records->appends(request()->query())->links()}}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{trans('admin.no_data')}}
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
@endsection
