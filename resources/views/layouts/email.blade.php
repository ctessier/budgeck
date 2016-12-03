<html>
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic&subset=latin');
            body { font-family: 'Open Sans', 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif; font-size: 0.8em; margin:0; padding: 2em; }
            .content { text-align: left; padding: 1em; border-radius: 4px; border: 1px solid rgba(34, 36, 38, 0.15); box-shadow: 0px 1px 2px 0 rgba(34, 36, 38, 0.15); }
            .button { background-color: #2185D0; color: #FFFFFF; border-radius: 4px; padding: 0.5em 1em; display: inline-block; text-decoration: none; }
        </style>
    </head>
    <body>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="80%">
            <tbody>
                <tr>
                    <td align="center">
                        <a href="{{ url() }}">
                            <img src="{{ asset('images/email_header.png') }}" border="0" width="170px"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <div class="content">
                            @yield('content')
                            <p>
                                Bien cordialement,<br />
                                Clément pour Budgeck.
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
