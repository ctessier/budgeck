<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="fr" > <![endif]-->
<!--[if IE 10]><html class="ie10" lang="fr" > <![endif]-->
<html class="no-js" lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title') | Budgeck</title>
        <link rel="stylesheet" href="/css/foundation.min.css" />
        <link rel="stylesheet" href="/css/app.css" />
        <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/js/common.js"></script>
        @yield('head')
    </head>
    <body>
        <div id="wrapper">
            @include('elements.header')
            <div class="row">
                @yield('content')
            </div>
            <div class="push"></div>
            @yield('tail')
        </div>
        @include('elements.footer')
        <div id="ajax-lightbox-background"></div>
        <div id="ajax-lightbox"></div>
    </body>
</html>
