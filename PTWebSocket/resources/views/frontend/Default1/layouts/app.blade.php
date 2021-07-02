<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">

	<title>@yield('page-title') - {{ settings('app_name') }}</title>
	<meta name="description" content="HTML template">

	<meta name="viewport" content="width=device-width">

	<link rel="icon" href="/frontend/Default1/img/favicon.png" >

	<link rel="stylesheet" href="/frontend/Default1/css/slick.css">
	<link rel="stylesheet" href="/frontend/Default1/css/grid.css">
	<link rel="stylesheet" href="/frontend/Default1/css/styles.min.css">
	
	<script src="/frontend/Default1/js/jquery-3.4.1.min.js"></script>

</head>

<body>

		@yield('content')

	<!-- SCRIPTS -->
	<script src="/frontend/Default1/js/slick.min.js"></script>
	<script src="/frontend/Default1/js/masonry-docs.min.js"></script>
	<script src="/frontend/Default1/js/custom.js"></script>

</body>
</html>