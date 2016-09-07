<a class="item">Tableau de bord</a>
{!! HTML::linkRoute('history', 'Historique', [], ['class' => 'item' . (Route::currentRouteNamed('history') ? ' active' : '')]) !!}
{!! HTML::linkRoute('monitoring', 'Suivi mensuel', [
    'year' => date('Y'),
    'month' => date('m')
], ['class' => 'item' . (Route::currentRouteNamed('monitoring') ? ' active' : '')])!!}
<div class="ui simple dropdown item">
    {{$user->firstname}}
    <i class="dropdown icon"></i>
    <div class="menu">
        {!! HTML::linkRoute('profile', 'Profil &amp; Comptes', [], ['class' => 'item' . (Route::currentRouteNamed('profile') ? ' active' : '')]) !!}
        {!! HTML::linkRoute('logout', 'Déconnexion', [], ['class' => 'item']) !!}
    </div>
</div>

<div class="ui item category search right">
    <div class="ui icon input">
        <input class="prompt" placeholder="Rechercher..." type="text">
        <i class="search icon"></i>
    </div>
    <!--<div class="results"></div>-->
</div>
