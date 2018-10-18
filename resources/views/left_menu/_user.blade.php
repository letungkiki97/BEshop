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
    <li {!! (Request::is( 'product/*') || Request::is( 'product') || Request::is( 'category/*') || Request::is( 'category') || Request::is( 'tag/*') || Request::is( 'tag') || Request::is( 'color/*') || Request::is( 'color') || Request::is( 'delivery_category/*') || Request::is( 'delivery_category') || Request::is( 'property/*') || Request::is( 'property') || Request::is( 'property_type/*') || Request::is( 'property_type') || Request::is( 'feature/*') || Request::is( 'feature') || Request::is( 'catalog/*') || Request::is( 'catalog') || Request::is( 'deleted_product/*') || Request::is( 'deleted_product') ? 'class="active"' : '') !!}>
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
            <li {!! (Request::is( 'product/*') || Request::is( 'product') ? 'class="active"' : '') !!}>
                <a href="{{url('product')}}">
                    <i class="material-icons text-danger">event_seat</i>
                    <span class="nav-text">{{__('left_menu.product')}}</span></a>
            </li>
            @endif
            @if($user_data->hasAccess(['deleted_product.list']) || $user_data->inRole('admin'))
            <li {!! Request::is('deleted_product') ? 'class="active"' : '' !!}>
                <a href="{{url('deleted_product')}}">
                    <i class="material-icons text-warning">delete</i>
                    <span class="nav-text">{{__('left_menu.deleted_product')}}</span></a>
            </li>
            @endif
            @if($user_data->hasAccess(['category.list']) || $user_data->inRole('admin'))
            <li {!! (Request::is( 'category/*') || Request::is( 'category') ? 'class="active"' : '') !!}>
                <a href="{{url('category')}}">
                    <i class="material-icons">web</i>
                    <span class="nav-text">{{__('left_menu.category')}}</span></a>
            </li>
            @endif
        </ul>
    </li>
    @endif
    {{-- Setting --}}
    @if(isset($user_data) && $user_data->inRole('admin'))
    <li {!! (Request::is( 'setting/*') || Request::is( 'setting') ? 'class="active"' : '') !!}>
        <a href="{{url('setting')}}">
            <span class="nav-icon">
     <i class="material-icons text-success">settings</i>
    </span>
            <span class="nav-text">{{__('left_menu.setting')}}</span>
        </a>
    </li>
    @endif
</ul>
