<div class="four wide column">
    <div class="ui vertical fluid menu">
        {!! HTML::linkRoute('profile', 'Mon profil', [], ['class' => 'item' . (Route::currentRouteNamed('profile') ? ' active' : '')]) !!}
        <a href="{{ route('accounts.index') }}" class="item {{ Route::currentRouteNamed('accounts.index') ? ' active' : '' }}">
            Tous mes comptes
            <div class="ui blue label">@amount($user->getTotalBalance())</div>
        </a>
        @foreach ($user->accounts as $account)
        <a href="{{ route('accounts.show', ['accounts' => $account->id]) }}" class="item {{ (Route::currentRouteNamed('accounts.show') && Route::getCurrentRoute()->getParameter('accounts') == $account) ? 'active' : '' }}">
            {{ $account->name }}
            <div class="ui label">@amount($account->getBalance())</div>
        </a>
        @endforeach
    </div>
</div>
