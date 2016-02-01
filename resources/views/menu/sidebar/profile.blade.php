<div class="columns large-4">
    <ul class="tabs">
        <li class="{!! (Route::currentRouteNamed('profile')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('profile', 'Mon profil') !!}
        </li>
        <li class="{!! (Route::currentRouteNamed('accounts') || Route::currentRouteNamed('accounts.getAccount')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('accounts', 'Mes comptes') !!}
            @if (Route::currentRouteNamed('accounts') || Route::currentRouteName('accounts.getAccount'))
            <ul>
                @foreach ($user->accounts as $account)
                <li class="{!! (Route::currentRouteNamed('accounts.getAccount') && Route::getCurrentRoute()->getParameter('account_id') == $account->id) ? 'active' : '' !!}">
                    {!! HTML::linkRoute('accounts.getAccount', $account->name, ['id' => $account->id]) !!}
                </li>
                @endforeach
            </ul>
            @endif
        </li>
    </ul>
</div>
