<!DOCTYPE html>
<html>
<head>
    @include('layouts._meta')
    @include('layouts._assets')

    @yield('styles')
</head>
<body>
<div id="app">
<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        @if(Settings::get('site_logo'))
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('uploads/site/'.Settings::get('site_logo')) }}" class="img-responsive" style="margin:5px auto;width:auto;height:40px;">
        </a>
        @endif
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i
                        class="fa fa-fw fa-navicon"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                @include("left_menu._header-right")
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">

                <!-- / .navigation -->
                @include('left_menu._user')
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    <aside class="right-side right-padding">
        <div class="right-content">
            <h1>{{ $title or __('message.welcome') }}</h1>

            <!-- Notifications -->

            <!-- Content -->
            @yield('content')
                    <!-- /.content -->
            <div id="loading"></div>
        </div>
    </aside>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
</div>
<!-- global js -->
@include('layouts._assets_footer')
@include('layouts._script')
@yield('scripts')
</body>
</html>