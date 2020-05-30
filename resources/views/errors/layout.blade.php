<!DOCTYPE html>

<html>
@include('helix::app.head')

<body class="error">
	
	<div class="header">
		<i class="icon icon-h"></i>
		<span class="text-thin">elix</span>
	</div>

	<h1>
		@yield('code')
	</h1>

	<p class="error-text">
		@yield('text')
	</p>

	@yield('additional')

	<a id="back" href="#" onclick="window.history.back()">
		@lang('helix::pages.back')
	</a>

	<i class="backdrop fa fa-@yield('icon')"></i>
</body>

</html>