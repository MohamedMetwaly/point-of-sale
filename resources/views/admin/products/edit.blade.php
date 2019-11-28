@extends('layouts.app')

@inject('category','App\Category')
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
                    'action' => ['admin\ProductController@update',$model->id],
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
                    <label for="description">{{trans('admin.description')}}</label>
                    {!!Form::textarea('description',null,[
                        'class' => 'form-control @error("description") is-invalid @enderror'
                    ])!!}
                </div>
                @error('description')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <label for="category_id">{{trans('admin.category')}}</label>
                    {!!Form::select('category_id',$category->pluck('name','id')->toArray(),null,[
                        'class' => 'form-control'
                    ])!!}
                </div>

                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    {!!Form::file('image',[
                        'class' => 'form-control image'
                    ])!!}
                </div>

                <div class="form-group">
                    @if($model->image != null)
                        <div class="form-group">
                            <img src="{{asset($model->image)}}" width="100px" class="thumbnail image_preview">
                        </div>
                    @else
                        <div class="form-group">
                            <img src="{{asset('uploads/basket.png')}}" width="100px" class="thumbnail image_preview">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="purchase_price">{{trans('admin.purchase_price')}}</label>
                    {!!Form::text('purchase_price',null,[
                        'class' => 'form-control @error("purchase_price") is-invalid @enderror'
                    ])!!}
                </div>
                @error('purchase_price')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <label for="sale_price">{{trans('admin.sale_price')}}</label>
                    {!!Form::text('sale_price',null,[
                        'class' => 'form-control @error("sale_price") is-invalid @enderror'
                    ])!!}
                </div>
                @error('sale_price')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror

                <div class="form-group">
                    <label for="stock">{{trans('admin.stock')}}</label>
                    {!!Form::text('stock',null,[
                        'class' => 'form-control @error("stock") is-invalid @enderror'
                    ])!!}
                </div>
                @error('stock')
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

    @push('scripts')
        <script>
            $('.image').change(function () {
                if (this.files && this.files[0]){
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.image_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        </script>
    @endpush

@endsection
