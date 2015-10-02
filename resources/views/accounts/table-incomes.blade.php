@if (count($account->incomes) > 0)
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
        @foreach ($account->incomes as $income)
        <tr>
            <td>{{ $income->title }}</td>
            <td>{{ $income->description }}</td>
            <td>&euro; {{ $income->amount }}</td>
            <td>{{ $income->day }}</td>
            <td class="align-center">{!! HTML::linkRoute('accounts.incomes.getEdit', 'Modifier', ['account_id' => $account->id, 'id' => $income->id], ['class' => 'btn-base radius right', 'data-use-lightbox' => 'true']) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! HTML::linkRoute('accounts.incomes.getEdit', 'Créer un revenu', $account->id, ['class' => 'btn-base radius right', 'data-use-lightbox' => 'true']) !!}
@else
<p>
    {!! HTML::linkRoute('accounts.incomes.getEdit', 'Créer un revenu', $account->id, ['data-use-lightbox' => 'true']) !!}
</p>
@endif