<div class="columns large-4">
    <ul class="tabs">
        @foreach ($user->accounts as $account)
        <li class="{!! ($current_account->id == $account->id) ? 'active' : '' !!}">
            <a href="">{{$account->name}}</a>
        </li>
        @endforeach
    </ul>
    @if (Route::currentRouteName() === 'history')
    {!! HTML::linkRoute('transactions.getEdit', 'Ajouter une transaction', ['transaction_id' => null, 'account_id' => Route::getCurrentRoute()->getParameter('account_id')], ['class' => 'btn-base radius', 'data-use-lightbox' => 'true']) !!}
    @endif
</div>
