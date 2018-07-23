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
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <title>Peppling</title>
    <script src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" ></script>
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
    <div class="container">
        <div class="header">
            <div class="header__logo"><a class="logotype" href="{!! route('main') !!}"></a></div>
            <div class="header__menu"><a class="menu_items" href="#"></a></div>
        </div>
    </div>
</header>
<main class="site_content">
    <div class="container">
        {!! Form::open(
           [
             'url'=>route('loginUser'),
             'class'=>'login',
             'method'=>'POST',
              'enctype'=>'multipart/form-data',
           ])
         !!}
        <input type="text" name="userName" placeholder="User Name" required>
        @if ($errors->has('userName'))
            <p class="errorMessage">
                <strong>{{ $errors->first('userName') }}</strong>
            </p>
        @endif
        <input type="password" name="password" placeholder="Password" required>
        @if ($errors->has('password'))
            <p class="errorMessage">
                <strong>{{ $errors->first('password') }}</strong>
            </p>
        @endif
        @if ($errors->has('bedUser'))
            <p class="errorMessage">
                <strong>{{ $errors->first('bedUser') }}</strong>
            </p>
        @endif
        @if ($errors->has('social'))
            <p class="errorMessage">
                <strong style="color: red">{{ $errors->first('social') }}</strong>
            </p>
        @endif
        <input type="submit" name="subLogin" value="Submit">
        <div class="social">
            <a  href="{{ route('facebook') }}"><i class="fab fa-facebook-square"></i></a>
            <a style="padding-left: 15px; color: black" href="{{ route('github') }}"><i class="fab fa-github"></i></a>
            <a style="padding-left: 15px;"  href="{{ route('google') }}"><i class="fab fa-google"></i></a>
            <a style="padding-left: 15px;" href="{{ route('twitter') }}"><i class="fab fa-twitter"></i></a>
            <a style="padding-left: 15px;" href="{{ route('linkedin') }}"><i class="fab fa-linkedin"></i></a>
        </div>
        {!! Form::close() !!}
    </div>
</main>
<footer>
    <div class="container">
        <div class="footer">
            <p class="footer__copyright">© Peppling 2018, All Rights Reserved.</p>
            <ul class="footer__menu">
                <li class="footer_items"><a class="footer_links" href="#">Privacy & Cookies</a></li>
                <li class="footer_items"><a class="footer_links" href="#">Legal</a></li>
                <li class="footer_items"><a class="footer_links" href="#">Advertise</a></li>
                <li class="footer_items"><a class="footer_links" href="#">Help</a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="{!! asset('js/libs.min.js') !!}"></script>
<script src="{!! asset('js/common.js') !!}"></script>
</body>
</html>