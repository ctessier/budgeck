<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="fr" > <![endif]-->
<!--[if IE 10]><html class="ie10" lang="fr" > <![endif]-->
<html class="no-js" lang="fr">
        <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>@yield('title', 'Budgeck')</title>
                {{HTML::script('js/jquery-1.11.1.min.js')}}
                {{HTML::script('js/common.js')}}
                {{HTML::style('css/foundation.min.css')}}
                {{HTML::style('css/style.css')}}
                @yield('head')
        </head>
        <body>
                @include('elements.header')
                @include('menu.default')
                <div class="row">
                @yield('content')
                </div>                
                @yield('tail')
                @include('elements.footer')
        </body>
</html>