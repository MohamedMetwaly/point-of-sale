<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@stack('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/skin-blue.min.css')}}">

    @if(app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/rtl/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/rtl/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/rtl/rtl.css')}}">
        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
    @endif
    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminlte/plugins/noty/noty.min.js') }}"></script>
    <!-- html in  ie -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{route('home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>{{trans('admin.pos')}}</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{trans('admin.home_title')}}</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                {{--<!-- inner menu: contains the actual data -->--}}
                                <ul class="menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @guest
                            @else
                                @if(auth()->user()->image != null)
                                    <img src="{{asset(auth()->user()->image)}}" width="18px" class="img-circle">
                                @else
                                    <img src="{{asset('uploads/default.png')}}" width="18px" class="img-circle">
                                @endif
                            @endguest
                            <span class="hidden-xs">
                                @guest
                                @else
                                    {{auth()->user()->name}}
                                @endguest
                             </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @guest
                                @else
                                    @if(auth()->user()->image != null)
                                        <img src="{{asset(auth()->user()->image)}}" class="img-circle">
                                    @else
                                        <img src="{{asset('uploads/default.png')}}" class="img-circle">
                                    @endif
                                @endguest
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">

                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right btn btn-danger">
                                    <a href="{{ route('logout') }}" style="color: white"
                                       onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                        <i class="fa fa-btn fa-sign"></i> تسجيل الخروج
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <br>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li><a href="{{url(route('user.index'))}}"><i class="fa fa-user"></i> <span>{{trans('admin.users')}}</span></a></li>
                <li><a href="{{url(route('role.index'))}}"><i class="fa fa-book"></i> <span>{{trans('admin.roles')}}</span></a></li>
                <li><a href="{{url(route('category.index'))}}"><i class="fa fa-book"></i> <span>{{trans('admin.categories')}}</span></a></li>
                <li><a href="{{url(route('product.index'))}}"><i class="fa fa-book"></i> <span>{{trans('admin.products')}}</span></a></li>
                <li><a href="{{url(route('client.index'))}}"><i class="fa fa-users"></i> <span>{{trans('admin.clients')}}</span></a></li>
                <li><a href="{{url(route('order.index'))}}"><i class="fa fa-first-order"></i> <span>{{trans('admin.orders')}}</span></a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
        @include('partials.session')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
{{--print this--}}
<script src="{{ asset('adminlte/dist/js/print.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>
{{--custom--}}
<script src="{{asset('adminlte/dist/js/custom/order.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
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

    $('.delete').click(function (e) {
        var that = $(this);
        e.preventDefault();
        var n = new Noty({
            text: '{{trans("admin.confirm_delete")}}',
            type: 'warning',
            killer: true,
            buttons: [
                Noty.button('{{trans("admin.delete")}}', 'btn btn-danger mr-2', function () {
                    that.closest('form').submit();
                }),
                Noty.button('{{trans("admin.close")}}', 'btn btn-default mr-2', function () {
                    n.close();
                })
            ]
        });
        n.show();
    });
</script>
@stack('scripts')
</body>
</html>
