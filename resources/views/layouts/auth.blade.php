<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts._meta')
    @include('layouts._assets')
</head>
<body id="bg-img">
<div class="authapp" id="app">
    <!-- ############ LAYOUT START-->
    <div class="login animated fadeIn" v-cloak>
        <div class="navbar">
                <!-- brand -->
            @include('flash::message')
            {{-- <a class="navbar-brand text-center" style="float:none;">
                <img src="{{ asset('uploads/site/'.Settings::get('site_logo')) }}"
                     alt="" class="img-responsive"
                     style="margin:auto;width:100px;height:35px;">
                </a> --}}
                <!-- / brand -->
        </div>
        @yield('content')
    </div>

    <!-- ############ LAYOUT END-->

</div>
@include('layouts._assets_footer')
</body>
</html>
