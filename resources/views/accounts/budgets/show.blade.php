<div class="ui header">
    <div class="content">
        {{ $budget->title }}
        <div class="sub header">{{ $budget->description }}</div>
    </div>
</div>
<div class="content">
    @if (count($budget->transactions) > 0)
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
                <td>{{ $transaction->transaction_date->formatLocalized('%A %d %B %Y') }}</td>
                <td>
                    @if (!is_null($transaction->value_date))
                        <i class="large green checkmark icon"></i>
                        @if ($transaction->value_date->diffInDays($transaction->transaction_date) === 0)
                            le même jour
                        @else
                            {{ $transaction->value_date->diffForHumans($transaction->transaction_date) }}
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="ui warning message">
        Ce budget ne contient aucune transaction.
    </div>
    @endif
</div>
<div class="actions">
    <div class="ui cancel button">Fermer</div>
</div>
