<div class="columns large-4">
    <ul class="tabs">
        <li class="{!! (Route::currentRouteNamed('profile')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('profile', 'Mon profil') !!}
        </li>
        <li class="{!! (Route::currentRouteNamed('accounts')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('accounts', 'Mes comptes') !!}
        </li>
        <li>
            <a href="#">Mes paramètres</a>
        </li>
    </ul>
</div>
