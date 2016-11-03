{!! HTML::linkRoute('history', 'Historique', [], ['class' => 'item' . (Route::currentRouteNamed('history') ? ' active' : '')]) !!}
{!! HTML::linkRoute('monitoring', 'Suivi mensuel', [
    'year' => date('Y'),
    'month' => date('m')
], ['class' => 'item' . (Route::currentRouteNamed('monitoring') ? ' active' : '')])!!}
{!! HTML::linkRoute('accounts.show', 'Paramètres', ['account' => $current_account->id], ['class' => 'item' . (Route::currentRouteNamed('accounts.show') ? ' active' : '')]) !!}

@if ($user->accounts->count() > 1)
<div class="ui simple dropdown item">
    Compte : {{ $current_account->name }}
    <i class="dropdown icon"></i>
    <div class="menu">
        @foreach ($user->accounts as $account)
            @if ($account != $current_account)
                {!! HTML::linkRoute('accounts.change', $account->name, ['accounts' => $account->id], ['class' => 'item']) !!}
            @endif
        @endforeach
    </div>
</div>
@endif

<div class="ui simple dropdown item right">
    {{ $user->firstname }}
    <i class="dropdown icon"></i>
    <div class="menu">
        {!! HTML::linkRoute('profile', 'Profil &amp; Comptes', [], ['class' => 'item' . (Route::currentRouteNamed('profile') ? ' active' : '')]) !!}
        {!! HTML::linkRoute('logout', 'Déconnexion', [], ['class' => 'item']) !!}
    </div>
</div>
