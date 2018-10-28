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
    {{-- Purchase group --}}
    @if(isset($user_data) && ($user_data->hasAccess(['purchase_management.list']) ||  $user_data->inRole('admin')))
    <li {!! (Request::is( 'quantri/order/*') || Request::is( 'quantri/order')) !!}>
        <a>
            <span class="nav-caret pull-right">
          <i class="fa fa-fw fa-caret-down"></i>
        </span>
            <span class="nav-icon">
            <i class="fa fa-fw fa-ship text-primary"></i>
        </span>
            <span class="nav-text">{{__('left_menu.purchase_management')}}</span>
        </a>
        <ul class="nav-sub">
            @if($user_data->hasAccess(['order.list']) || $user_data->inRole('admin'))
            <li {!! ((Request::is( 'quantri/order/*') || Request::is( 'quantri/order')) && !request()->status ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/order')}}">
                    <i class="fa fa-fw fa-ship text-info"></i>
                    <span class="nav-text">{{__('left_menu.purchase')}} - All</span>
                </a>
            </li>
            @endif
            @if($user_data->hasAccess(['order.draft']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/order*') && request()->status == 'Draft' ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/order?status=Draft')}}">
                    <i class="fa fa-fw fa-ship text-warning"></i>
                    <span class="nav-text">{{__('left_menu.purchase')}} - Draft</span>
                </a>
            </li>
            @endif
            @if($user_data->hasAccess(['order.active']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/order*') && request()->status == 'Active' ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/order?status=Active')}}">
                    <i class="fa fa-fw fa-ship"></i>
                    <span class="nav-text">{{__('left_menu.purchase')}} - Active</span>
                </a>
            </li>
            @endif
            @if($user_data->hasAccess(['order.received']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/order*') && request()->status == 'Received' ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/order?status=Received')}}">
                    <i class="fa fa-fw fa-ship text-success"></i>
                    <span class="nav-text">{{__('left_menu.purchase')}} - Received</span>
                </a>
            </li>
            @endif
            @if($user_data->hasAccess(['order.paid']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/order*') && request()->status == 'Paid' ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/order?status=Paid')}}">
                    <i class="fa fa-fw fa-ship text-primary"></i>
                    <span class="nav-text">{{__('left_menu.purchase')}} - Paid</span>
                </a>
            </li>
            @endif
            @if($user_data->hasAccess(['order.cancelled']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'quantri/order*') && request()->status == 'Cancelled' ? 'class="active"' : '') !!}>
                <a href="{{url('quantri/order?status=Cancelled')}}">
                    <i class="fa fa-fw fa-ship text-danger"></i>
                    <span class="nav-text">{{__('left_menu.purchase')}} - Cancelled</span>
                </a>
            </li>
            @endif
        </ul>
    </li>
    @endif 

    {{-- Content group --}}
    @if(isset($user_data) && ($user_data->hasAccess(['content_management.list']) || $user_data->inRole('admin')))
        <li {!! Request::is( 'quantri/image/*') || Request::is('quantri/image') ? 'class="active"' : '' !!}>
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
                 @if($user_data->hasAccess(['image.list']) || $user_data->inRole('admin'))
                    <li {!! (Request::is( 'quantri/image/*') || Request::is( 'quantri/image') ? 'class="active"' : '') !!}>
                        <a href="{{url('quantri/image')}}">
                            <i class="material-icons text-warning">camera_alt</i>
                            <span class="nav-text">{{__('left_menu.image')}}</span></a>
                    </li>
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
