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
                                                    <span class="hidden-xs">{{CRUDBooster::myName()}}</span>
                                                  </a>
                                                  <ul class="dropdown-menu">
                                                        <li class="user-header">
                                                            <img src="{{CRUDBooster::myPhoto()}}" class="img-circle" alt="User Image">
                                                            <p>{{CRUDBooster::myName()}}
                                                                <small>{{CRUDBooster::myUnit()}}</small>
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
                                            <a href="\ma\login">LOGIN</a>
                                            @endif
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
                                    <img src="/media/6277/logo-atas.png" onerror="this.onerror=null; this.src='/media/6277/logo-atas.png?widht=278'">
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
