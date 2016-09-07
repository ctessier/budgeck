<a class="item">Tableau de bord</a>
{!! HTML::linkRoute('history', 'Historique', [], ['class' => 'item' . (Route::currentRouteNamed('history') ? ' active' : '')]) !!}
{!! HTML::linkRoute('monitoring', 'Suivi mensuel', [
    'year' => date('Y'),
    'month' => date('m')
], ['class' => 'item' . (Route::currentRouteNamed('monitoring') ? ' active' : '')])!!}
@if ($user->accounts->count() > 1)
    <div class="ui simple dropdown item">
        Compte : {{$current_account->name}}
        <i class="dropdown icon"></i>
        <div class="menu">
            @foreach ($user->accounts as $account)
                @if ($account != $current_account)
                    <a href="#" class="item">{{$account->name}}</a>
                @endif
            @endforeach
        </div>
    </div>
@endif

<div class="ui simple dropdown item right">
    {{$user->firstname}}
    <i class="dropdown icon"></i>
    <div class="menu">
        {!! HTML::linkRoute('profile', 'Profil &amp; Comptes', [], ['class' => 'item' . (Route::currentRouteNamed('profile') ? ' active' : '')]) !!}
        {!! HTML::linkRoute('logout', 'Déconnexion', [], ['class' => 'item']) !!}
    </div>
</div>
