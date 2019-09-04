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
                                        {{ Session::get('message') }} | <a href="\ma\login">LOGIN</a>
                                    </span>
									@elseif (!empty($id))
                                Selamat datang, <a href="\ma\users\profile">{{$nama}} <img src="{{$foto}}" class="user-image" alt="User Image"></a> | <a href="\ma">Member Area</a> | <a href="\ma\logout">LOGOUT</a>
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
											<a href="">
												<img src="/media/6277/logo-atas.png" onerror="this.onerror=null; this.src='/media/6277/logo-atas.png?widht=278'">
											</a>

										</li>
									</ul>
										<script>
											function click_menu(tap_id,def){
												$('.col'+def).html('<ul><li><a onclick="javascript:$(`.col'+def+'`).html(``);$(`.'+def+'`).show()"><i class="fa-ico-left"></i> Kembali</a></li></ul>'+$('.'+tap_id).html());
												$('.'+def).hide();
											}
										</script>
										<script type="text/javascript">
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
									<ul class="menu-links" style="display: none; max-height: 400px; overflow: auto;">
										<li class="hoverTrigger">
											<a href="\">Beranda<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\">e-Reporting<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\">Informasi PNBP<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\">Helpdesk<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\">FAQ<div class="mobileTriggerButton"></div></a>
                                        </li>
                                        <li class="hoverTrigger">
											<a href="\">Tautan<div class="mobileTriggerButton"></div></a>
										</li>
									</ul>
									<div class="mm-page" style="display:none;">
										<nav id="my-menu" >
										</nav>
									</div>
								</div>
							</section>
						</nav>
			</header>
    	</div>
