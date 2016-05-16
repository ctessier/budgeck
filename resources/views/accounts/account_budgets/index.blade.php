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
            <td>&euro; {{ $account_budget->amount }}</td>
            <td class="align-center">{!! HTML::linkRoute('accounts.account_budgets.edit', 'Modifier', ['accounts' => $account->id, 'budgets' => $account_budget->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Ajouter des budgets pour commencer à gérer les finances de ce compte.</p>
@endif
