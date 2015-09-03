@if (count($account->budgets) > 0)
    @if (count($account->singleBudgets) > 0)
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Montant</th>
            <th>Jour du mois</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($account->singleBudgets as $budget)
        <tr>
            <td>{{ $budget->title }}</td>
            <td>{{ $budget->description }}</td>
            <td>&euro; {{ $budget->amount }}</td>
            <td>{{ $budget->day }}</td>
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
        </tr>
    </thead>
    <tbody>
        @foreach ($account->multipleBudgets as $budget)
        <tr>
            <td>{{ $budget->title }}</td>
            <td>{{ $budget->description }}</td>
            <td>&euro; {{ $budget->amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
    @endif
    {!! HTML::linkRoute('budgets.create', 'Créer un budget', null, ['class' => 'btn-base radius right']) !!}
@else
<p>
    <a href="">Créer un budget</a>
</p>
@endif