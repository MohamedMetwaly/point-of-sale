@extends('layouts.app')

@inject('model','App\User')
@inject('role','App\Role')
@push('title')
    {{trans('admin.new_admin')}}
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.new_admin')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.new_admin')}}</li>
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
                    'action' => 'admin\UserController@store',
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
                    <img src="{{asset('uploads/default.png')}}" width="100px" class="thumbnail image_preview">
                </div>

                <div class="form-group">
                    <label for="password">{{trans('admin.password')}}</label><br>
                    {!!Form::password('password',[
                        'class' => 'form-control @error("password") is-invalid @enderror'
                    ])!!}
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <label for="password_confirmation">{{trans('admin.password_confirmation')}}</label><br>
                    {!!Form::password('password_confirmation',[
                        'class' => 'form-control @error("password_confirmation") is-invalid @enderror'
                    ])!!}
                </div>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror


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
