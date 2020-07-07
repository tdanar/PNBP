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
        </div>
    </body>
    @include('partials.footer')
</html>
