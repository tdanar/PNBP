<!-- Main Header -->
<div id="my-header">
    <header>

    <!-- Logo -->
{{--     <a href="{{url(config('crudbooster.FRONT'))}}" title='{{Session::get('appname')}}' class="logo">{{CRUDBooster::getSetting('appname')}}</a>
 --}}


    <!-- Header Navbar -->
        <div class="top-header">
            <div class="hidden-desk"><span class="mobile-nav"></span></div>
                <div class="info-header">
                    <div class="container">
                        <div class="left-top">
                                <span></span>
                                <font>
                                        Jl. Dr.Wahidin Raya No 1 Jakarta 10710
                                </font>
                        </div>
                        <div class="right-top">
                            {{-- <span><font> </font>134</span> --}}

                            @if (!empty(CRUDBooster::myId()))
                            Selamat datang, <a href="\ma\users\profile">{{CRUDBooster::myName()}} <img src="{{CRUDBooster::myPhoto()}}" class="user-image" alt="User Image"></a> | <a href="\ma\users\profile">Member Area</a> | <a href="\ma\logout">LOGOUT</a>
                            @else
                            <a href="\ma\login">LOGIN</a>
                            @endif
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

        </div>
    <nav id="menu-1" class="mega-menu" data-color="#f00">
        <section class="menu-list-items">
                <div class="container">
                    <ul class="menu-logo">
                        <li>
                            <a href="/">
                                <img src="/media/6277/logo-atas.png" onerror="this.onerror=null; this.src='/media/6277/logo-atas.png?widht=278'">
                            </a>
{{--                             <div id="ikeh" class="container-button icon" >
                                    <div class="icon">
                                      <div class="bar1"></div>
                                      <div class="bar2"></div>
                                      <div class="bar3"></div>
                                    </div>
                            </div> --}}
                        </li>
                    </ul>


                        <ul class="menu-links" >
                                {{-- <ul class="menu-links nav navbar-nav"> --}}
                                @foreach(CRUDBooster::sidebarMenu() as $menu)
                                        <li data-id='{{$menu->id}}' class='hoverTrigger {{-- {{(!empty($menu->children))?"treeview":""}} --}} {{ (Request::is($menu->url_path."*"))?"active":""}}'>
                                            @if(!empty($menu->children))
                                            <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":/* $menu->url */"javascript:void(0)" }}'>
                                                    {{$menu->name}}<div class="mobileTriggerButton"></div>
                                            </a>
                                            <div class='drop-down effect-fade' style="transition: all 400ms ease 0s;">
                                                    <div class="grid-row">
                                                            <div class="grid-col-12">
                                                               <div class="cls_border">
                                                                    <ul>
                                                                        @foreach($menu->children as $child)
                                                                            <li data-id='{{$child->id}}' class='{{(Request::is($child->url_path .= !ends_with(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}}'>
                                                                                <a href='{{ ($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url}}'
                                                                                >
                                                                                    {{$child->name}}

                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                               </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            @else
                                            <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$menu->url }}'>
                                                {{$menu->name}}
                                                <div class="mobileTriggerButton"></div>
                                            </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mm-page" style="display:none;">
                                        <nav id="my-menu" >
                                            <ul>
                                                    @foreach(CRUDBooster::sidebarMenu() as $menu)
                                                    <li data-id='{{$menu->id}}' class='{{ (Request::is($menu->url_path."*"))?"active":""}}'>
                                                        @if(!empty($menu->children))
                                                        <span>
                                                        <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":/* $menu->url */"javascript:void(0)" }}'>
                                                        {{$menu->name}}</a>
                                                            </span>
                                                                    <ul {{-- class="dropdown-menu" role="menu" --}}>
                                                                        @foreach($menu->children as $child)
                                                                            <li data-id='{{$child->id}}' class='{{(Request::is($child->url_path .= !ends_with(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}}'>
                                                                                <a href='{{ ($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url}}'>
                                                                                    {{$child->name}}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                        @else
                                                        <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$menu->url }}'
                                                            >
                                                            {{$menu->name}}
                                                        </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </nav>
                                </div>
                        <!-- /.navbar-collapse -->
                        <!-- Navbar Right Menu -->
                            {{-- <div class="navbar-custom-menu">
                                <ul class="menu-links nav navbar-nav">
                                    <li class="dropdown notifications-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title='Notifications' aria-expanded="false">
                                            <i id='icon_notification' class="fa fa-bell-o"></i>
                                            <span id='notification_count' class="label label-danger" style="display:none">0</span>
                                        </a>
                                        <ul id='list_notifications' class="dropdown-menu">
                                            <li class="header">{{trans("crudbooster.text_no_notification")}}</li>
                                            <li>
                                                <!-- inner menu: contains the actual data -->
                                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                                    <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                                        <li>
                                                            <a href="#">
                                                                <em>{{trans("crudbooster.text_no_notification")}}</em>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                    <div class="slimScrollBar"
                                                        style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px; background: rgb(0, 0, 0);"></div>
                                                    <div class="slimScrollRail"
                                                        style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                                                </div>
                                            </li>
                                            <li class="footer"><a href="{{route('NotificationsControllerGetIndex')}}">{{trans("crudbooster.text_view_all_notification")}}</a></li>
                                        </ul>
                                    </li>

                                    <!-- User Account Menu -->
                                     <li class="dropdown user user-menu">
                                        <!-- Menu Toggle Button -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <!-- The user image in the navbar-->
                                            <img src="{{ CRUDBooster::myPhoto() }}" class="user-image" alt="User Image"/>
                                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                            <span class="hidden-xs">{{ CRUDBooster::myName() }}</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <!-- The user image in the menu -->
                                            <li class="user-header">
                                                <img src="{{ CRUDBooster::myPhoto() }}" class="img-circle" alt="User Image"/>
                                                <p>
                                                    {{ CRUDBooster::myName() }}
                                                    <small>{{ CRUDBooster::myPrivilegeName() }}</small>
                                                    <small><em></em></small>
                                                </p>
                                            </li>

                                            <!-- Menu Footer-->
                                            <li class="user-footer">
                                                <div class="pull-{{ trans('crudbooster.left') }}">
                                                    <a href="{{ route('AdminCmsUsersControllerGetProfile') }}" class="btn btn-default btn-flat"><i
                                                                class='fa fa-user'></i> {{trans("crudbooster.label_button_profile")}}</a>
                                                </div>
                                                <div class="pull-{{ trans('crudbooster.right') }}">
                                                    <a title='Lock Screen' href="{{ route('getLockScreen') }}" class='btn btn-default btn-flat'><i class='fa fa-key'></i></a>
                                                    <a href="javascript:void(0)" onclick="swal({
                                                            title: '{{trans('crudbooster.alert_want_to_logout')}}',
                                                            type:'info',
                                                            showCancelButton:true,
                                                            allowOutsideClick:true,
                                                            confirmButtonColor: '#DD6B55',
                                                            confirmButtonText: '{{trans('crudbooster.button_logout')}}',
                                                            cancelButtonText: '{{trans('crudbooster.button_cancel')}}',
                                                            closeOnConfirm: false
                                                            }, function(){
                                                            location.href = '{{ route("getLogout") }}';

                                                            });" title="{{trans('crudbooster.button_logout')}}" class="btn btn-danger btn-flat"><i class='fa fa-power-off'></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div> --}}
                    </div>
            </section>
        </nav>

</header>
</div>
<div class="clear"></div>

