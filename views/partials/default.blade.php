<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('page_title', 'Olive - Framework')</title>
	<link rel="stylesheet" href="/assets/css/main.css" />
	@yield('css')
</head>
<body>
	<section>
		@yield('content')		
	</section>
	<footer>
		@yield('js')
	</footer>
</body>
</html>