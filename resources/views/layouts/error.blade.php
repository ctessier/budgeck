<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="fr" ><![endif]-->
<!--[if IE 10]><html class="ie10" lang="fr" ><![endif]-->
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title') | {{ config('budgeck.appName') }}</title>
        <link rel="stylesheet" href="{{ elixir('assets/css/semantic.css') }}" />
        <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}" />
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #CCCCCC;
                display: table;
                font-weight: 100;
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            .content {
                text-align: center;
                display: inline-block;
            }
            .logo {
                margin-bottom: 70px;
            }
            .title {
                font-size: 36px;
                margin-bottom: 90px;
                line-height: 42px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="logo">
                    {!! HTML::image(asset('images/budgeck_logo_SMALL.png')) !!}
                </div>
                <div class="title">
                    @yield('content')
                </div>
                <a href="/" class="ui button blue">Revenir au site</a>
            </div>
        </div>
    </body>
</html>
