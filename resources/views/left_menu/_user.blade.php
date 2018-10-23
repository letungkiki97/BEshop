<div class="nav_profile">
    <div class="media profile-left">
        <a class="pull-left profile-thumb" href="{{url('/profile')}}">
            @if($user_data->user_avatar)
                <img src="{!! url('/').'/uploads/avatar/'.$user_data->user_avatar !!}" alt="img"
                     class="img-rounded"/>
            @else
                <img src="{{ url('uploads/avatar/user.png') }}" alt="img" class="img-rounded"/>
            @endif
        </a>
        <div class="content-profile">
            <h4 class="media-heading">{{ str_limit($user_data->full_name, 15) }}</h4>
            <h5 style="color: #C1CBCC">{{$user_data->email}}</h5>
        </div>
    </div>
</div>
<ul class="navigation">
    {{-- Product group --}}
    @if(isset($user_data) && ($user_data->hasAccess(['product_management.list']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'quantri/product/*') || Request::is( 'quantri/product') || Request::is( 'quantri/category/*') || Request::is( 'quantri/category') || Request::is( 'quantri/color/*') || Request::is( 'quantri/color') || Request::is( 'quantri/deleted_product/*') || Request::is( 'quantri/deleted_product') ? 'class="active"' : '') !!}>
        <a>
            <span class="nav-caret pull-right">
          <i class="fa fa-fw fa-caret-down"></i>
        </span>
            <span class="nav-icon">
           <i class="material-icons text-primary">event_seat</i>
        </span>
            <span class="nav-text">{{__('left_menu.product_management')}}</span>
        </a>
        <ul class="nav-sub">
            @if($user_data->hasAccess(['product.list']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/product/*') || Request::is( 'quantri/product') ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/product')}}">
                    <i class="material-icons text-danger">event_seat</i>
                    <span class="nav-text">{{__('left_menu.product')}}</span></a>
            </li>
            @endif
            @if($user_data->hasAccess(['deleted_product.list']) || $user_data->inRole('admin'))
            <li {!! Request::is('quantri/deleted_product') ? 'class="active"' : '' !!}>
                <a href="{{url('quantri/deleted_product')}}">
                    <i class="material-icons text-warning">delete</i>
                    <span class="nav-text">{{__('left_menu.deleted_product')}}</span></a>
            </li>
            @endif
            @if($user_data->hasAccess(['category.list']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/category/*') || Request::is( 'quantri/category') ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/category')}}">
                    <i class="material-icons">web</i>
                    <span class="nav-text">{{__('left_menu.category')}}</span></a>
            </li>
            @endif
        </ul>
    </li>
    @endif
    {{-- Content group --}}
    @if(isset($user_data) && ($user_data->hasAccess(['content_management.list']) || $user_data->inRole('admin')))
        <li {!! (Request::is( 'menu/*') || Request::is( 'menu') || Request::is( 'news_category/*') || Request::is( 'news_category') || Request::is( 'news/*') || Request::is( 'news') || Request::is( 'page/*') || Request::is( 'page') || Request::is( 'banner/*') || Request::is( 'banner') || Request::is( 'advice/*') || Request::is( 'advice') || Request::is( 'newsletter/*') || Request::is( 'newsletter') || Request::is( 'news_tag/*') || Request::is( 'news_tag') || Request::is( 'mail/*') || Request::is( 'mail') || Request::is( 'content_setting' || Request::is('product_filters') || Request::is( 'footer/*') || Request::is( 'footer')|| Request::is( 'image/*') || Request::is( 'image') || Request::is( 'source/*') || Request::is( 'source')) ? 'class="active"' : '') !!}>
            <a>
            <span class="nav-caret pull-right">
              <i class="fa fa-fw fa-caret-down"></i>
            </span>
                <span class="nav-icon">
                   <i class="material-icons text-warning">web</i>
                </span>
                <span class="nav-text">{{__('left_menu.content_management')}}</span>
            </a>
            <ul class="nav-sub">
                @if($user_data->hasAccess(['banner.list']) || $user_data->inRole('admin'))
                    <li {!! (Request::is( 'quantri/banner/*') || Request::is( 'quantri/banner') ? 'class="active"' : '') !!}>
                        <a href="{{url('quantri/banner')}}">
                            <i class="fa fa-image text-danger"></i>
                            <span class="nav-text">{{__('left_menu.banner')}}</span></a>
                    </li>
                @endif
                @if($user_data->hasAccess(['mail.list']) || $user_data->inRole('admin'))
                    <li {!! (Request::is( 'mail/*') || Request::is( 'mail') ? 'class="active"' : '') !!}>
                        <a href="{{url('mail')}}">
                            <i class="fa fa-envelope-open text-primary"></i>
                            <span class="nav-text">{{__('left_menu.mail')}}</span></a>
                    </li>
                @endif
                @if($user_data->inRole('admin'))
                    <li {!! (Request::is( 'content_setting') ? 'class="active"' : '') !!}>
                        <a href="{{url('content_setting')}}">
                            <i class="fa fa-wrench text-danger"></i>
                            <span class="nav-text">{{__('left_menu.content_setting')}}</span></a>
                    </li>
                    @if($user_data->hasAccess(['footer.list']) || $user_data->inRole('admin'))
                        <li {!! (Request::is( 'footer/*') || Request::is( 'footer') ? 'class="active"' : '') !!}>
                            <a href="{{url('footer')}}">
                                <i class="material-icons text-info">view_agenda</i>
                                <span class="nav-text">{{__('left_menu.footer')}}</span></a>
                        </li>
                    @endif
                    @if($user_data->hasAccess(['image.list']) || $user_data->inRole('admin'))
                        <li {!! (Request::is( 'quantri/image/*') || Request::is( 'quantri/image') ? 'class="active"' : '') !!}>
                            <a href="{{url('quantri/image')}}">
                                <i class="material-icons text-warning">camera_alt</i>
                                <span class="nav-text">{{__('left_menu.image')}}</span></a>
                        </li>
                    @endif
                @endif
            </ul>
        </li>
    @endif

    {{-- Setting --}}
    @if(isset($user_data) && $user_data->inRole('admin'))
    <li {!! (Request::is( 'quantri/setting/*') || Request::is( 'quantri/setting') ? 'class="active"' : '') !!}>
        <a href="{{url('quantri/setting')}}">
            <span class="nav-icon">
     <i class="material-icons text-success">settings</i>
    </span>
            <span class="nav-text">{{__('left_menu.setting')}}</span>
        </a>
    </li>
    @endif
</ul>
