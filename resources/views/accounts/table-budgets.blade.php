@if (count($account->budgets) > 0)
    @if (count($account->singleBudgets) > 0)
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Montant</th>
            <th>Jour du mois</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($account->singleBudgets as $budget)
        <tr>
            <td>{{ $budget->title }}</td>
            <td>{{ $budget->description }}</td>
            <td>&euro; {{ $budget->amount }}</td>
            <td>{{ $budget->day }}</td>
            <td class="align-center">{!! HTML::linkRoute('accounts.budgets.getEdit', 'Modifier', ['account_id' => $account->id, 'id' => $budget->id], ['class' => 'btn-base radius right', 'data-use-lightbox' => 'true']) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endif
    @if (count($account->multipleBudgets) > 0)
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
        @foreach ($account->multipleBudgets as $budget)
        <tr>
            <td>{{ $budget->title }}</td>
            <td>{{ $budget->description }}</td>
            <td>&euro; {{ $budget->amount }}</td>
            <td class="align-center">{!! HTML::linkRoute('accounts.budgets.getEdit', 'Modifier', ['account_id' => $account->id, 'id' => $budget->id], ['class' => 'btn-base radius right', 'data-use-lightbox' => 'true']) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endif
    {!! HTML::linkRoute('accounts.budgets.getEdit', 'Créer un budget', ['account_id' => $account->id], ['class' => 'btn-base radius right', 'data-use-lightbox' => 'true']) !!}
@else
<p>
    {!! HTML::linkRoute('accounts.budgets.getEdit', 'Créer un budget', ['account_id' => $account->id], ['data-use-lightbox' => 'true']) !!}
</p>
@endif