<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="fr" > <![endif]-->
<!--[if IE 10]><html class="ie10" lang="fr" > <![endif]-->
<html class="no-js" lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title') | Budgeck</title>
        <link rel="stylesheet" href="{{ elixir('assets/css/foundation.min.css') }}" />
        <link rel="stylesheet" href="{{ elixir('assets/css/semantic.css') }}" />
        <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}" />
        <script type="text/javascript" src="{{ elixir('assets/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ elixir('assets/js/semantic.js') }}"></script>
        <script type="text/javascript" src="{{ elixir('assets/js/common.js') }}"></script>
        <script type="text/javascript" src="{{ elixir('assets/js/script.js') }}"></script>
        @yield('head')
    </head>
    <body>
        @include('elements.header')
        <div class="ui main container">
            @yield('content')
        </div>
        @yield('tail')
        @include('elements.footer')
    </body>
</html>
