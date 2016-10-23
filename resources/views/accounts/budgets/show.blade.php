<div class="header">
    <div class="content">
        {{ $budget->title }}
        <div class="sub header">{{ $budget->description }}</div>
    </div>
</div>
<div class="content">
    <table class="ui very basic table">
        <thead>
            <th>Titre</th>
            <th>Montant</th>
            <th>Date</th>
            <th>Débité ?</th>
        </thead>
        <tbody>
            @foreach ($budget->transactions as $transaction)
            <tr>
                <td>{{ $transaction->title }}</td>
                <td>@amount($transaction->amount)</td>
                <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                <td>
                    @if (!is_null($transaction->value_date))
                    <i class="large green checkmark icon"></i>
                    {{ $transaction->value_date->format('d/m/Y') }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="actions">
    <div class="ui cancel button">Fermer</div>
</div>
