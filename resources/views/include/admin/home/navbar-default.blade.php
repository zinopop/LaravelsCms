<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" src="{{ $users['avatar'] }}" style="width: 64px;height: 64px"></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{{ $users['user'] }}</strong></span>
                                <span class="text-muted text-xs block">{{ $users['nickname'] }}<b class="caret"></b></span>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="{{ route('admin.home.home.editAvatar') }}">修改头像</a>
                        </li>
                        <li><a class="J_menuItem" href="profile.html">个人资料</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.login.logout') }}">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">清
                </div>
            </li>
            @foreach($menuList as $k => $v)
                <li>
                    @if($v['route_url'] != '#')
                    <a href="{{ url($v['route_url']) }}" class="J_menuItem">
                        <i class="{{ $v['route_ico'] }}"></i>
                        <span class="nav-label">{{ $v['route_name'] }}</span>
                        <span class="fa arrow"></span>
                    </a>
                    @else
                    <a href="{{ url($v['route_url']) }}">
                        <i class="{{ $v['route_ico'] }}"></i>
                        <span class="nav-label">{{ $v['route_name'] }}</span>
                        <span class="fa arrow"></span>
                    </a>
                    @endif

                    @if(!empty($v['son_data']))
                    <ul class="nav nav-second-level">
                        @foreach($v['son_data'] as $k2 => $v2)
                        <li>
                            @if($v2['route_url'] != "#" && empty($v2['son_data']))
                            <a class="J_menuItem" href="{{ url($v2['route_url']) }}">{{ $v2['route_name'] }} </a>
                            @elseif($v2['route_url'] == "#" && !empty($v2['son_data']))
                            <a href="{{ url($v2['route_url']) }}">{{ $v2['route_name'] }} <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                @foreach($v2['son_data'] as $k3 => $v3)
                                    <li><a class="J_menuItem" href="{{ url($v3['route_url']) }}">{{ $v3['route_name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            @elseif($v2['route_url'] != "#" && !empty($v2['son_data']))
                            <a class="J_menuItem" href="{{ url($v2['route_url']) }}">{{ $v2['route_name'] }} <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                @foreach($v2['son_data'] as $k3 => $v3)
                                <li><a class="J_menuItem" href="{{ url($v3['route_url']) }}">{{ $v3['route_name'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @elseif($v2['route_url'] == "#" && empty($v2['son_data']))
                            <a href="{{ url($v2['route_url']) }}">{{ $v2['route_name'] }} </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endforeach

        </ul>
    </div>
</nav>