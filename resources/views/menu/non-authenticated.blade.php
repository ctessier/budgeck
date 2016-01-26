<li {!! (Route::currentRouteNamed('login')) ? 'class="active"' : '' !!}>
    {!! HTML::linkRoute('login', 'Connexion') !!}
</li>
