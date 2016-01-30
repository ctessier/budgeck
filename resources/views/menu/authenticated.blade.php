<li {!! (Route::currentRouteNamed('history')) ? 'class="active"' : '' !!}>
    {!! HTML::linkRoute('history', 'Historique', $user->getDefaultAccount()) !!}
</li>   
<li {!! (Route::currentRouteNamed('accounts.month')) ? 'class="active"' : '' !!}>
    {!! HTML::linkRoute('accounts.month', 'Budgets', [
        'account_id' => $user->getDefaultAccount(),
        'year' => date('Y'),
        'month' => date('m')
    ])!!}
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
