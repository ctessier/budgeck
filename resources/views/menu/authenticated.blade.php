<li>
    <a>Tableau de bord</a>
</li>
<li {!! (Route::currentRouteNamed('history')) ? 'class="active"' : '' !!}>
    {!! HTML::linkRoute('history', 'Historique') !!}
</li>
<li {!! (Route::currentRouteNamed('monitoring')) ? 'class="active"' : '' !!}>
    {!! HTML::linkRoute('monitoring', 'Suivi mensuel', [
        'year' => date('Y'),
        'month' => date('m')
    ])!!}
</li>
<li {!! (Route::currentRouteNamed('profile')) ? 'class="active"' : '' !!}>
    <a>{{$user->firstname}}</a>
    <ul>
        <li>
            {!! HTML::linkRoute('profile', 'Profil &amp; Comptes') !!}
        </li>
        <li>
            {!! HTML::linkRoute('logout', 'Déconnexion') !!}
        </li>
    </ul>
</li>
