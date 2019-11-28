@extends('layouts.app')

@inject('model','App\Category')
@push('title')
    {{trans('admin.add_category')}}
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.add_category')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.add_category')}}</li>
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
                    'action' => 'admin\CategoryController@store'
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
