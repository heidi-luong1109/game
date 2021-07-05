<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">

	<title>@yield('page-title') - {{ settings('app_name') }}</title>
	<meta name="description" content="HTML template">

	<meta name="viewport" content="width=device-width">

	<link rel="icon" href="/frontend/Flaming777v1/img/favicon.png">
	
	<link rel="stylesheet" href="/frontend/Flaming777v1/css/slick.css">
	<link rel="stylesheet" href="/frontend/Flaming777v1/css/styles.min.css">

</head>

<body style="background-image: url('/frontend/Flaming777v1/img/_src/main-bg.png')">

	<!-- MAIN -->

	@yield('content')

	<!-- /.MAIN -->

	<!-- SCRIPTS -->

	<script src="/frontend/Flaming777v1/js/jquery-3.4.1.min.js"></script>
	<script src="/frontend/Flaming777v1/js/slick.min.js"></script>
	<script src="/frontend/Flaming777v1/js/custom.js"></script>
		
	
</body>
</html>