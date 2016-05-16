<div class="columns large-4">
    <ul class="tabs">
        <li class="{!! (Route::currentRouteNamed('profile')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('profile', 'Mon profil') !!}
        </li>
        <li class="{!! (Route::currentRouteNamed('accounts.index') || Route::currentRouteNamed('accounts.show')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('accounts.index', 'Mes comptes') !!}
            <span class="total-balance">{{ $user->getTotalBalance() }} &euro;</span>
            @if (Route::currentRouteNamed('accounts') || Route::currentRouteName('accounts.getAccount'))
            <ul>
                @foreach ($user->accounts as $account)
                <li class="{!! (Route::currentRouteNamed('accounts.show') && Route::getCurrentRoute()->getParameter('accounts') == $account) ? 'active' : '' !!}">
                    {!! HTML::linkRoute('accounts.show', $account->name, ['accounts' => $account->id]) !!}
                    <span class="account-balance">{{ $account->getBalance() }} &euro;</span>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
    </ul>
</div>
