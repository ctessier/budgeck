@if ($account->account_budgets->count() > 0)
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Montant</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($account->account_budgets as $account_budget)
        <tr>
            <td>{{ $account_budget->title }}</td>
            <td>{{ $account_budget->description }}</td>
            <td>@amount($account_budget->amount)</td>
            <td class="align-center">
                {!! HTML::linkRoute('accounts.account_budgets.edit', 'Modifier', ['accounts' => $account->id, 'budgets' => $account_budget->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
                {!! Form::open(['method' => 'delete', 'route' => ['accounts.account_budgets.destroy', $account->id, $account_budget->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer ce budget ? Cela affectera seulement les budgets des mois futurs.']) !!}
                    <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer</a>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Ajouter des budgets pour commencer à gérer les finances de ce compte.</p>
@endif
