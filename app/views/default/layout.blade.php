<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

	{{ HTML::style('css/style.css') }}
	{{ HTML::script('assets/jQuery.js') }}
	{{ HTML::script('js/main.js') }}

</head>
<body>
	
	@yield('main-menu')
	@yield('header')
	@yield('top-content')
	@yield('content')

</body>
</html>
