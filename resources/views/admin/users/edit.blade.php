@extends('layouts.app')

@inject('role','App\Role')
@push('title')
    {{trans('admin.edit')}}
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.edit')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.edit')}}</li>
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
                    'action' => ['admin\UserController@update',$model->id],
                    'method' => 'put',
                    'files'  => true
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
                    <label for="email">{{trans('admin.email')}}</label>
                    {!!Form::text('email',null,[
                        'class' => 'form-control @error("email") is-invalid @enderror'
                    ])!!}
                </div>
                @error('email')
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
                    @if($model->image != null)
                        <img src="{{asset($model->image)}}" width="100px" class="thumbnail image_preview">
                    @else
                        <img src="{{asset('uploads/default.png')}}" width="100px" class="thumbnail image_preview">
                    @endif
                </div>

                <div class="form-group">
                    <label for="roles_list">{{trans('admin.roles')}}</label>
                    {!!Form::select('roles_list[]',$role->pluck('display_name','id')->toArray(),null,[
                        'class' => 'form-control',
                        'multiple' => 'multiple'
                    ])!!}
                </div>
                @error('roles_list')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <button class="btn btn-success" type="Submit"><i class="fa fa-save"></i>{{trans('admin.save')}}</button>
                </div>

                {!!Form::close()!!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
