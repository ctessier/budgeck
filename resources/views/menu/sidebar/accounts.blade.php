<div class="columns large-4">    
    <ul class="tabs">
        <li class="{!! ($account_id == 'all') ? 'active' : '' !!}">
            {!! HTML::linkRoute('history', 'Tous mes comptes', 'all') !!}
        </li>
        @foreach ($user->accounts as $account)
        <li class="{!! ($account_id == $account->id) ? 'active' : '' !!}">
            {!! HTML::linkRoute('history', $account->name, $account->id) !!}
        </li>
        @endforeach
    </ul>
</div>
