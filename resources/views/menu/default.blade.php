<nav>
    <ul class="right">
        @if (Auth::check())
        <li {!! (Route::currentRouteNamed('dashboard')) ? 'class="active"' : '' !!}>
            {!! HTML::linkRoute('dashboard', 'Tableau de bord') !!}
        </li>
        <li {!! (Route::currentRouteNamed('profile')) ? 'class="active"' : '' !!}>
            {!! HTML::linkRoute('profile', 'Mon profil') !!}
        </li>        
        <li {!! (Route::currentRouteNamed('accounts') || Route::currentRouteNamed('accounts.getAccount')) ? 'class="active"' : '' !!}>
            {!! HTML::linkRoute('accounts', 'Mes comptes') !!}
        </li>
        <li>
            {!! HTML::linkRoute('logout', 'Déconnexion') !!}
        </li>
        @else
        <li {!! (Route::currentRouteNamed('login')) ? 'class="active"' : '' !!}>
            {!! HTML::linkRoute('login', 'Connexion') !!}
        </li>
        @endif
    </ul>
</nav>
