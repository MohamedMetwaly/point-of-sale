@extends('layouts.app')

@inject('users','App\User')
@inject('clients','App\Client')
@push('title')
    {{trans('admin.home_title')}}
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.dashboard')}}
            <small>{{trans('admin.statistics')}}</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="ion ion-person-add"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.users')}}</span>
                        <span class="info-box-number">{{$users->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('admin.clients')}}</span>
                        <span class="info-box-number">{{$clients->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-bag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Orders</span>
                        <span class="info-box-number">c</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        </div>
    </section>
    <!-- /.content -->
@endsection
