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
                                {{-- <span><font> </font>134</span> --}}
                                @if (!empty(CRUDBooster::myId()))
                                Selamat datang, {{CRUDBooster::myName()}} dari {{CRUDBooster::myUnit()}} <img src="{{CRUDBooster::myPhoto()}}" class="user-image" alt="User Image"> | <a href="\ma\users\profile">Member Area</a> | <a href="\ma\logout">LOGOUT</a>
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
                                <div id="ikeh" class="container-button icon" >
                                        <div class="icon">
                                          <div class="bar1"></div>
                                          <div class="bar2"></div>
                                          <div class="bar3"></div>
                                        </div>
                                </div>
                            </li>
                        </ul>
                        <script type="text/javascript">
                                function click_menu(tap_id,def){
                                    $('.col'+def).html('<ul><li><a onclick="javascript:$(`.col'+def+'`).html(``);$(`.'+def+'`).show()"><i class="fa-ico-left"></i> Kembali</a></li></ul>'+$('.'+tap_id).html());
                                    $('.'+def).hide();
                                }

                                $(document).ready(function() {
                                    $("#my-menu").mmenu({
                                        // options
                                        offCanvas: {
                                        position: "right"
                                        }
                                    }, {
                                        // configuration
                                        offCanvas: {
                                            pageSelector: "#my-wrapper"

                                        }
                                    });

                                    var API = $("#my-menu").data( "mmenu" );
                                    $('#ikeh').click(function() {
                                        API.open();
                                    });

                                });
                            </script>

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
