<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Collect Accounting</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ajaxForm.js') }}" ></script>
    
    @yield('js-links')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css-links')
    @yield('css')


</head> 
<body>
    <div id="app">
        <div id='cssmenu'>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

        
    <footer>
    <h2 class="hidden">Our footer</h2>
    <section id="copyright">
    <h3 class="hidden">Copyright notice</h3>
    <div class="wrapper">&copy; Copyright 2015 by GoonsApp. All Rights Reserved.</div>
    </section>
    <section class="wrapper">
    <h3 class="hidden">Footer content</h3>
    <article class="column">
    <h4>Contact Us</h4>
    support@collectaccounting.com</article>
    <article class="column midlist">
    <h4>Quick Links</h4>
    <ul>
    <li><a href="javascript:void(0)">License Agreement</a></li>
    <li><a href="http://collectaccounting.com/Login.php">Login</a></li>
    <li><a href="javascript:void(0)">Download</a></li></ul></article>
    <article class="column rightlist">
    <h4>About Us</h4>
    collectaccounting is cloud storage system. We focus on providing platform for record keeping.
    <ul>
    <li></li>
    </ul></article></section>
    <a href="#" class="go-top">Go Top</a>
    </footer>

    @yield('js')
</body>
</html>
