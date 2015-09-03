<div class="columns large-4">
    <ul class="tabs">
        @foreach ($accounts as $acc)
        <li class="{!! ($acc->id == $account->id) ? 'active' : '' !!}">
            {!! HTML::linkRoute('accounts.getAccount', $acc->name, ['id' => $acc->id]) !!}
        </li>
        @endforeach
    </ul>
</div>