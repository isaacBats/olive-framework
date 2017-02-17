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
		<script src="https://code.jquery.com/jquery-2.2.2.min.js" ></script>
		@yield('js')
	</footer>
</body>
</html>