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
                                    @if ( Session::get('message') != '' )
                                    <span>
                                        {{ Session::get('message') }} | <a href="#" data-toggle="popover-login" data-content="<div class='holds-the-iframe'><iframe src='/ma/login' style='height:600px;width:450px;' frameborder='0'></iframe></div>">LOGIN</a>
                                    </span>
                                    @elseif (!empty($id))
                                    <ul class="nav navbar-nav">
                                            <li class="dropdown user user-menu">
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
                                            </li>
                                        </ul>
									@else
									<a href="#" data-toggle="popover-login" data-content="<div class='holds-the-iframe'><iframe src='/ma/login' style='height:600px;width:450px;' frameborder='0'></iframe></div>">LOGIN</a>
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
									<a href="">
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
										<script>
											function click_menu(tap_id,def){
												$('.col'+def).html('<ul><li><a onclick="javascript:$(`.col'+def+'`).html(``);$(`.'+def+'`).show()"><i class="fa-ico-left"></i> Kembali</a></li></ul>'+$('.'+tap_id).html());
												$('.'+def).hide();
											}
										</script>

                                        @if(!empty(CRUDBooster::myId()))
                                    <ul class="menu-links" style="display: none; max-height: 400px; overflow: auto;">

                                        @foreach(CRUDBooster::sidebarMenu() as $menu)
                                            <li class='hoverTrigger {{ (Request::is($menu->url_path."*"))?"active":""}}'>
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
                                                                                    <a href='{{ ($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url}}'>
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
                                    @endif

                                    @if(empty(CRUDBooster::myId()))
                                    <ul class="menu-links" style="display: none; max-height: 400px; overflow: auto;">
                                        <li class="hoverTrigger">
											<a href="\">Beranda<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
                                            <a href="\ma\lap_awas">eReporting<div class="mobileTriggerButton"></div></a>

                                        </li>
                                        <li class="hoverTrigger">
											<a href="\infopnbp">Informasi PNBP<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\helpdesk">Hubungi Kami<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\faq">FAQ<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
                                            <a href="javascript:void(0)">Tautan<div class="mobileTriggerButton"></div></a>
                                            <div class="drop-down effect-fade " style="transition: all 400ms ease 0s;">
                                                <div class="grid-row">
                                                  <div class="grid-col-12">
                                                     <div class="cls_border">
                                                         <ul>
                                                            <li><a href="http://sidatik.kkp.go.id/">Sidatik (Kementerian Kelautan dan Perikanan)</a>
                                                            </li>
                                                            <li><a href="http://www.perizinan.kkp.go.id/">SIPEPI (Kementerian Kelautan dan Perikanan)</a>
                                                            </li>
                                                            <li><a href="http://calculator2050.esdm.go.id/">Kalkulator Energi (Kementerian ESDM)</a>
                                                            </li>
                                                            <li><a href="https://epnbpminerba.esdm.go.id/">E-PNBP Minerba (Kementerian ESDM)</a>
                                                            </li>
                                                            <li><a href="https://moms.esdm.go.id/">MOMS (Kementerian ESDM)</a>
                                                            </li>
                                                            <li><a href="http://silk.dephut.go.id/">SILK (Kementerian Lingkungan Hidup dan Kehutanan)</a>
                                                            </li>
                                                            <li><a href="http://ppkh.menlhk.go.id/">SIPPKH (Kementerian Lingkungan Hidup dan Kehutanan)</a>
                                                            </li>
                                                         </ul>
                                                     </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

									<div class="mm-page" style="display:none;">
										<nav id="my-menu" >
                                            <ul>
                                                <li>
                                                    <a href="\">Beranda</a>
                                                </li>
                                                <li>
                                                    <a href="\ma\lap_awas">eReporting</a>
                                                </li>
                                                <li>
                                                    <a href="\infopnbp" target="_blank">Informasi PNBP</a>
                                                </li>
                                                <li>
                                                    <a href="\helpdesk">Hubungi Kami</a>
                                                </li>
                                                <li>
                                                    <a href="\faq">FAQ</a>
                                                </li>
                                                <li>
                                                    <span>
                                                        <a href="javascript:void(0)">Tautan</a>
                                                    </span>
                                                        <ul>
                                                                <li><a href="http://sidatik.kkp.go.id/">Sidatik (Kementerian Kelautan dan Perikanan)</a>
                                                                </li>
                                                                <li><a href="http://www.perizinan.kkp.go.id/">SIPEPI (Kementerian Kelautan dan Perikanan)</a>
                                                                </li>
                                                                <li><a href="http://calculator2050.esdm.go.id/">Kalkulator Energi (Kementerian ESDM)</a>
                                                                </li>
                                                                <li><a href="https://epnbpminerba.esdm.go.id/">E-PNBP Minerba (Kementerian ESDM)</a>
                                                                </li>
                                                                <li><a href="https://moms.esdm.go.id/">MOMS (Kementerian ESDM)</a>
                                                                </li>
                                                                <li><a href="http://silk.dephut.go.id/">SILK (Kementerian Lingkungan Hidup dan Kehutanan)</a>
                                                                </li>
                                                                <li><a href="http://ppkh.menlhk.go.id/">SIPPKH (Kementerian Lingkungan Hidup dan Kehutanan)</a>
                                                                </li>
                                                        </ul>
                                                </li>
                                            </ul>
										</nav>
                                    </div>
                                    @endif
								</div>
							</section>
						</nav>
			</header>
        </div>

