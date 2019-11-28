@extends('layouts.app')

@push('title')
    {{trans('admin.new_permission')}}
@endpush
@inject('model','App\Role')
@inject('perms','App\Permission')

@section('content')

    <section class="content-header">
        <h1>
            {{trans('admin.new_permission')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.new_permission')}}</li>
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
                    'action' => 'admin\RoleController@store'
                ])!!}

                    <div class="form-group">
                        <label for="name">{{trans('admin.name')}}</label>
                        {!!Form::text('name',null,[
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
                        {!!Form::text('display_name',null,[
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
                        {!!Form::textarea('description',null,[
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
                                            <input type="checkbox" name="permissions_list[]" value="{{$perm->id}}"> {{$perm->display_name}}
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
                        <button class="btn btn-primary" type="Submit"><i class="fa fa-plus"></i>{{trans('admin.add')}}</button>
                    </div>

                {!!Form::close()!!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
    @push('scripts')
        <script>
            $('#select-all').click(function () {
                $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
            });
        </script>
    @endpush
@endsection


