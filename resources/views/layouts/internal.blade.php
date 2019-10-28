<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Collect Accounting</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/ajaxForm.js') }}" ></script>
    @yield('js-links')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css-links')
    @yield('css')

    <style type="text/css">
        #cssmenu {
            padding-bottom: 20px;
        }

        #cssmenu ul {
            position: absolute;
            width: 100%;
            border-bottom: 2px solid blue;
        }

        #cssmenu li {
            list-style: none;
            float: left;
            padding-left: 20px;
        }
    </style>


</head> 
<body>
    <div id="app">
        <div id='cssmenu'>
            <ul>
                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                

                 <li><a href="{{ route('income') }}">Income</a></li>
                    <li><a href="{{ route('expense') }}">Expenses</a></li>
                    <li><a href="{{ route('graph') }}">Graphs</a></li>
                    <li><a href="{{ route('report') }}">Reports</a></li>

            </ul>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>    
    

    @yield('js')
</body>
</html>
