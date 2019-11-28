@extends('layouts.app')

@push('title')
    {{trans('admin.roles')}}
@endpush

@section('content')

    <section class="content-header">
        <h1>
            {{trans('admin.roles')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.dashboard')}}</a></li>
            <li class="active">{{trans('admin.roles')}}</li>
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
                <a href="{{url(route('role.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('admin.new_permission')}}</a>
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.permission')}}</th>
                                    <th>{{trans('admin.display_name')}}</th>
                                    <th class="text-center">{{trans('admin.edit')}}</th>
                                    <th class="text-center">{{trans('admin.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->display_name}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('role.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['admin\RoleController@destroy',$record->id],
                                            'method' => 'delete'
                                        ]) !!}
                                            <button type="Submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <!-- /.content -->
@endsection
