<div class="four wide column">
    <div class="ui vertical pointing fluid menu">
        {!! HTML::linkRoute('profile', 'Mon profil', [], ['class' => 'item' . (Route::currentRouteNamed('profile') ? ' active' : '')]) !!}
        <a href="{{ route('accounts.index') }}" class="item {{ Route::currentRouteNamed('accounts.index') ? ' active' : '' }}">
            Tous mes comptes
            {{--*/ $totalBalance = $user->getTotalBalance() /*--}}
            <div class="ui label {{ $totalBalance < 0 ? 'red' : 'green' }}">@amount($totalBalance)</div>
        </a>
        @foreach ($user->accounts as $account)
        <a href="{{ route('accounts.show', ['accounts' => $account->id]) }}" class="item {{ (Route::currentRouteNamed('accounts.show') && Route::getCurrentRoute()->getParameter('accounts') == $account) ? 'active' : '' }}">
            {{ $account->name }}
            {{--*/ $accountBalance = $account->getBalance() /*--}}
            <div class="ui label {{ $accountBalance < 0 ? 'red' : 'green' }}">@amount($accountBalance)</div>
        </a>
        @endforeach
    </div>
</div>
