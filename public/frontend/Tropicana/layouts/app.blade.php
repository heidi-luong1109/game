<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="apple-touch-icon" sizes="57x57" href="/img/appicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/appicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/appicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/appicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/appicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/appicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/appicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/appicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/appicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/img/appicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/appicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/appicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/appicon/favicon-16x16.png">
        <link rel="manifest" href="/img/appicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <title>@yield('page-title') - {{ settings('app_name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Rye&family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
        <link rel="stylesheet" href="/frontend/Tropicana/css/style.css">
    </head>
    <body csrf="{{ csrf_token() }}">
        @include('frontend.Tropicana.dashboard.components.header')
        @include('frontend.Tropicana.dashboard.components.infobar')
        @include('frontend.Tropicana.dashboard.components.search')

        <div class="dashboard">

          @if (@isset($show_lm) && $show_lm == false)

          @else
            @include('frontend.Tropicana.dashboard.components.leftmenu')
          @endif

          <section>
            @yield('content')
          </section>

        </div>

    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" charset="utf-8"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sly/1.6.1/sly.min.js" defer charset="utf-8"></script>
    <script src="/frontend/Tropicana/js/custom.js"></script>
</html>
