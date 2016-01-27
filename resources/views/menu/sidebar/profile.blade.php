<div class="columns large-4">
    <ul class="tabs">
        <li class="{!! (Route::currentRouteNamed('profile')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('profile', 'Mon profil') !!}
        </li>
        <li class="{!! (Route::currentRouteNamed('accounts') || Route::currentRouteName('accounts.getAccount')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('accounts', 'Mes comptes') !!}
            @if (Route::currentRouteNamed('accounts') || Route::currentRouteName('accounts.getAccount'))
            <ul>
                @foreach ($user->accounts as $account)
                <li>
                    {!! HTML::linkRoute('accounts.getAccount', $account->name, ['id' => $account->id]) !!}
                </li>
                @endforeach
            </ul>
            @endif
        </li>
    </ul>
</div>
