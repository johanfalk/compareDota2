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

	<h4>76561198011435969</h4>

	@yield('header')
	@yield('content')
</body>
</html>
