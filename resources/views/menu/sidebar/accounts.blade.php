<div class="columns large-4">   
    <ul class="tabs">
        <li class="{!! ($account_id == 'all') ? 'active' : '' !!}">
            {!! HTML::linkRoute(Route::currentRouteName(), 'Tous mes comptes', ['account_id' => 'all', 'year' => Route::getCurrentRoute()->getParameter('year'), 'month' => Route::getCurrentRoute()->getParameter('month')]) !!}
        </li>
        @foreach ($user->accounts as $account)
        <li class="{!! ($account_id == $account->id) ? 'active' : '' !!}">
            {!! HTML::linkRoute(Route::currentRouteName(), $account->name, ['account_id' => $account->id, 'year' => Route::getCurrentRoute()->getParameter('year'), 'month' => Route::getCurrentRoute()->getParameter('month')]) !!}
        </li>
        @endforeach
    </ul>
    @if (Route::currentRouteName() === 'history')
    {!! HTML::linkRoute('transactions.getEdit', 'Ajouter une transaction', ['transaction_id' => null, 'account_id' => Route::getCurrentRoute()->getParameter('account_id')], ['class' => 'btn-base radius', 'data-use-lightbox' => 'true']) !!}
    @endif
</div>
