<!-- Main Header -->
<div id="my-header">
        <header>
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
                                <ul class="nav navbar-nav">
                                    <li class="dropdown user user-menu">
                                            @if (!empty(CRUDBooster::myId()))
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <!-- The user image in the navbar-->
                                                    <img src="{{CRUDBooster::myPhoto()}}" class="user-image" alt="User Image">
                                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                                    <span class="hidden-xs">{{ str_limit(CRUDBooster::myUnit(), $limit = 50, $end = '...') }}</span>
                                                          </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li class="user-header">
                                                            <img src="{{CRUDBooster::myPhoto()}}" class="img-circle" alt="User Image">
                                                            <p><small>{{CRUDBooster::myUnit()}}</small>
                                                                {{CRUDBooster::myName()}}
                                                            </p>
                                                        </li>
                                                        <li class="user-footer">
                                                            <div class="pull-left">
                                                                <a href="\ma\users\profile" class="btn btn-primary btn-flat">Profil</a>
                                                            </div>
                                                            <div class="pull-right">
                                                                <a href="\ma\logout" class="btn btn-danger btn-flat">Log Out</a>
                                                            </div>
                                                        </li>
                                                  </ul>
                                            @else
                                            <ul class="nav navbar-nav"><li class="dropdown user user-menu" ><a href="#" class="btn btn-primary" data-toggle="popover-login" data-content="<div class='holds-the-iframe'><iframe src='/ma/login' style='height:600px;width:450px;' frameborder='0'></iframe></div>">LOGIN</a></li></ul>
                                            @endif
                                    </li>
                                    <li class="dropdown notifications-menu">
                                        <a href="#" class="btn-flat btn-default dropdown-toggle" data-toggle="dropdown" title='Notifications' aria-expanded="false">
                                        {{CRUDBooster::MyPrivilegeName()}} &nbsp;<i id='icon_notification' class="far fa-bell"></i>
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
                                </ul>
                                {{-- <span><font> </font>134</span> --}}

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
                                    <img src="{{ CRUDBooster::getSetting("gambar_logo")?asset(CRUDBooster::getSetting('gambar_logo')):asset('media/6277/logo-atas.png') }}?widht=278">
                                </a>
                                <div id="ikeh2" class="container-button icon" >
                                        <div class="icon">
                                          <div class="bar1"></div>
                                          <div class="bar2"></div>
                                          <div class="bar3"></div>
                                        </div>
                                </div>
                            </li>
                        </ul>
                        @push('bottom')
                        <script type="text/javascript" src="/scripts/jquery.mmenu.all.js"></script>
                        <script>
                                function click_menu(tap_id,def){
                                    $('.col'+def).html('<ul><li><a onclick="javascript:$(`.col'+def+'`).html(``);$(`.'+def+'`).show()"><i class="fa-ico-left"></i> Kembali</a></li></ul>'+$('.'+tap_id).html());
                                    $('.'+def).hide();
                                }
                            </script>
                        <script>
                                $(document).ready(function() {
                                    var API = $("#my-menu").mmenu({
                                        // options
                                        offCanvas: {
                                        position: "right"
                                        }
                                    }, {
                                        // configuration
                                        offCanvas: {
                                            pageSelector: "#my-wrapper"

                                        }
                                    }).data('mmenu');

                                    $('#ikeh2').click(function(ev) {
                                        ev.preventDefault();
                                        API.open();
                                    });

                                });
                            </script>
                        @endpush

                            {{--<ul class="menu-links" >--}}
                                     <ul class="menu-links" style="display: none; max-height: 400px; overflow: auto;">
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
                        </div>
                </section>
            </nav>

    </header>
    </div>
    <div class="clear">

    </div>