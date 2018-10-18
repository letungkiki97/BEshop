<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
        @if($user_data->user_avatar)
            <img src="{!! url('/').'/uploads/avatar/'.$user_data->user_avatar !!}" alt="img"
                 class="img-circle img-responsive pull-left" height="35" width="35"/>
        @else
            <img src="{{ url('uploads/avatar/user.png') }}" alt="img"
                 class="img-circle img-responsive pull-left" height="35" width="35"/>
        @endif
        <div class="riot">
            <div>
                {{str_limit($user_data->full_name, 25)}}
                <span>
                                        <i class="caret"></i>
                                    </span>
            </div>
        </div>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            @if($user_data->user_avatar)
                <img src="{!! url('/').'/uploads/avatar/'.$user_data->user_avatar !!}" alt="img"
                     class="img-circle img-bor"/>
            @else
                <img src="{{ url('uploads/avatar/user.png') }}"
                     alt="img" class="img-circle img-bor"/>
            @endif
            <p>{{str_limit($user_data->full_name, 25)}}</p>
        </li>
        <!-- Menu Body -->
        <li class="pad-3">
            <a href="{{ url('profile') }}">
                <i class="fa fa-fw fa-user"></i>
                My Profile
            </a>
        </li>
        <li role="presentation"></li>
        <li role="presentation" class="divider"></li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-right">
                <a href="{{ url('logout') }}" class="text-danger">
                    <i class="fa fa-fw fa-sign-out"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</li>