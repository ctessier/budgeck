<li {!! (Route::currentRouteNamed('history')) ? 'class="active"' : '' !!}>
    {!! HTML::linkRoute('history', 'Historique', $user->getDefaultAccount()) !!}
</li>   
<li>
    <a href="">Budgets</a>
</li>
<li>
    <a href="">Graphiques</a>
</li>
<li {!! (Route::currentRouteNamed('profile')) ? 'class="active"' : '' !!}>
    <a>{{$user->firstname}}</a>
    <ul>
        <li>
            {!! HTML::linkRoute('profile', 'Profil &amp; comptes') !!}
        </li>
        <li>
            {!! HTML::linkRoute('logout', 'Déconnexion') !!}    
        </li>
    </ul>
</li>
