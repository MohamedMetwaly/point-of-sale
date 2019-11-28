@extends('layouts.app')

@inject('model','App\Client')
@push('title')
    {{trans('admin.new_client')}}
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.new_client')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.new_client')}}</li>
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
            </div>
            <div class="box-body">
                {!!Form::model($model,[
                    'action' => 'admin\ClientController@store',
                    'files' => true
                ])!!}

                <div class="form-group">
                    <label for="name">{{trans('admin.name')}}</label>
                    {!!Form::text('name',null,[
                        'class' => 'form-control @error("name") is-invalid @enderror'
                    ])!!}
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <label for="phone">{{trans('admin.phone')}}</label>
                    {!!Form::text('phone',null,[
                        'class' => 'form-control @error("phone") is-invalid @enderror'
                    ])!!}
                </div>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    {!!Form::file('image',[
                        'class' => 'form-control image'
                    ])!!}
                </div>

                <div class="form-group">
                    <img src="{{asset('uploads/default.png')}}" width="100px" class="thumbnail image_preview">
                </div>

                <div class="form-group">
                    <label for="address">{{trans('admin.address')}}</label>
                    {!!Form::text('address',null,[
                        'class' => 'form-control @error("address") is-invalid @enderror'
                    ])!!}
                </div>
                @error('address')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <button class="btn btn-primary" type="Submit"><i class="fa fa-plus"></i>{{trans('admin.add')}}</button>
                </div>

                {!!Form::close()!!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
