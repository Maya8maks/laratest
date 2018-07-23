<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="title" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <title>Peppling</title>
    <!--link(rel="apple-touch-icon", sizes="180x180", href="favicon/apple-touch-icon.png")-->
    <!--link(rel="icon", type="image/png", sizes="32x32", href="favicon/favicon-32x32.png")-->
    <!--link(rel="icon", type="image/png", sizes="16x16", href="favicon/favicon-16x16.png")-->
    <!--link(rel="manifest", href="favicon/manifest.json")-->
    <!--link(rel="mask-icon", href="favicon/safari-pinned-tab.svg", color="#5bbad5")-->
    <!--meta(name="theme-color", content="#ffffff")-->
    <link href="{!! asset('css/main.min.css') !!}" rel="stylesheet">
</head>
<body class="site">
<header>
    @yield('header')
</header>
<main class="site_content">
    <div class="dashboard">
        @yield('sidebar')
        @yield('content')
    </div>
</main>
<footer>
    <div class="container">
        @yield('footer')
    </div>
</footer>
<script src="{!! asset('js/libs.min.js') !!}"></script>
<script src="{!! asset('js/common.js') !!}"></script>
</body>
</html>