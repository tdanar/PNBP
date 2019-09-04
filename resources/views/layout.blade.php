<!DOCTYPE html>
<html lang="id" xml:lang="id" xmlns="http://www.w3.org/1999/xhtml">
@include('partials.head')
<body>
	<div id="scroll"></div>
		<div id="preload" class="preload">
			<div class="loader"></div>
		</div>
    <div class="mm-page"></div>
    <div id="my-wrapper">
        @include('partials.header')
    	@yield('content')
        @include('partials.footer')
        </div>
    </div>
        <!--
		<div id="sticky-social">
			<ul>
				<li><a href="#" class="entypo-facebook" target="_blank"><span>Facebook</span></a></li>
				<li><a href="#" class="entypo-twitter" target="_blank"><span>Twitter</span></a></li>
				<li><a href="#" class="entypo-youtube" target="_blank"><span>Youtube</span></a></li>
				<li><a href="#" class="entypo-gplus" target="_blank"><span>Google+</span></a></li>
			</ul>
		</div>
		-->

    </body>

<!-- Mirrored from slicing-kemenkeu.mediaiklan.id/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2017 16:13:40 GMT -->
</html>
