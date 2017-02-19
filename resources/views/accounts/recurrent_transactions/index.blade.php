{{--*/ $recurrent_transactions = $account->recurrent_transactions /*--}}
@if ($recurrent_transactions->count() > 0)
    <table class="ui table">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Montant</th>
            <th>Jour du mois</th>
            <th>Mois suivant</th>
            <th>Budget</th>
            <th>Catégorie</th>
            <th style="width:5%"></th>
        </tr>
        </thead>
        <tbody>
        {{--*/ $recurrentTransactionsTotalAmount = 0 /*--}}
        @foreach ($recurrent_transactions as $recurrent_transaction)
            {{--*/ $recurrentTransactionsTotalAmount += $recurrent_transaction->amount /*--}}
            <tr>
                <td>{{ $recurrent_transaction->title }}</td>
                <td>@amount($recurrent_transaction->amount)</td>
                <td>{{ $recurrent_transaction->day }}</td>
                <td>
                    @if ($recurrent_transaction->next_month)
                        <i class="large green checkmark icon"></i>
                    @endif
                </td>
                <td>{{ $recurrent_transaction->account_budget ? $recurrent_transaction->account_budget->title : '' }}</td>
                <td>{{ $recurrent_transaction->category_id ? $recurrent_transaction->category->name : '' }}</td>
                <td>
                    <div class="ui icon top left pointing dropdown mini settings-icon">
                        <i class="angle down icon"></i>
                        <div class="menu">
                            {!! HTML::linkRoute('accounts.recurrent_transactions.edit', 'Modifier', ['accounts' => $account->id, 'recurrent_transaction' => $recurrent_transaction->id], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                            {!! Form::open(['method' => 'delete', 'route' => ['accounts.recurrent_transactions.destroy', $account->id, $recurrent_transaction->id], 'class' => 'item', 'data-use-confirm' => 'true', 'data-confirm-modal-title' => 'Supprimer l\'opération récurrente : ' . $recurrent_transaction->title, 'data-confirm-modal-message' => 'Souhaitez-vous définitivement supprimer cette opération récurrente ?']) !!}
                            <div type="submit">Supprimer</div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>{{ $recurrent_transaction->count() }} opération(s) récurrente(s)</th>
            <th>@amount($recurrentTransactionsTotalAmount)</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
@else
    <p>Vous n'avez aucun opération récurrente.</p>
@endif

<a href="{{ route('accounts.recurrent_transactions.create', ['accounts' => $account->id]) }}" class="ui icon mini button" data-use-modal="true">
    <i class="add icon"></i>
    Ajouter une opération récurrente
</a>

<script>
    $('.dropdown').dropdown({
        action: "hide"
    });
</script>
