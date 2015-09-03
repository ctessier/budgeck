@if (count($account->incomes) > 0)
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
        @foreach ($account->incomes as $income)
        <tr>
            <td>{{ $income->title }}</td>
            <td>{{ $income->description }}</td>
            <td>&euro; {{ $income->amount }}</td>
            <td>{{ $income->day }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! HTML::linkRoute('incomes.create', 'Créer un revenu', null, ['class' => 'btn-base radius right']) !!}
@else
<p>
    <a href="">Créer un revenu</a>
</p>
@endif