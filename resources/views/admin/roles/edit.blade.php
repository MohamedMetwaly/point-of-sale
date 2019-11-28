@extends('layouts.app')

@push('title')
    {{trans('admin.edit_permission')}}
@endpush
@inject('perms','App\Permission')

@section('content')

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
                    'action' => ['admin\RoleController@update',$model->id],
                    'method' => 'put'
                ])!!}

                    <div class="form-group">
                        <label for="name">{{trans('admin.name')}}</label>
                        {!!Form::text('name',old('name'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                     @error('name')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror

                    <div class="form-group">
                        <label for="display_name">{{trans('admin.display_name')}}</label>
                        {!!Form::text('display_name',old('display_name'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    @error('display_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group">
                        <label for="description">{{trans('admin.description')}}</label>
                        {!!Form::textarea('description',old('description'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>

                    <div class="form-group">
                        <label for="permissions_list">{{trans('admin.roles')}}</label><br>
                        <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label><br>
                        <div class="row">
                            @foreach($perms->all() as $perm)
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions_list[]" value="{{$perm->id}}"

                                            @if($model->hasPermission($perm->name))
                                                checked
                                            @endif

                                            > {{$perm->display_name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('permissions_list')
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
@push('scripts')
        $("#select-all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    @endpush
    </section>
    <!-- /.content -->

@endsection
