<div class="four wide column">
    <div id="add-transaction-dropdown" class="ui dropdown fluid button">
        <i class="add icon"></i>
        Ajouter une transaction
        <div class="menu">
            {!! HTML::linkRoute('accounts.transactions.create', 'Dépense', ['accounts' => $current_account->id], ['class' => 'item', 'data-use-modal' => 'true']) !!}
            {!! HTML::linkRoute('accounts.transactions.create', 'Revenu', ['accounts' => $current_account->id, 'income'], ['class' => 'item', 'data-use-modal' => 'true']) !!}
        </div>
    </div>
</div>
