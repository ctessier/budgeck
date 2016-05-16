@extends('layouts.lightbox')

@section('content')
<div class="row">
    <div class="columns small-12">
        <h3>{{ $budget->title }}</h3>
        <p>
            <i>{{ $budget->description }}</i>
        </p>
        <table>
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
                    <td>{{ $transaction->amount }} &euro;</td>
                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                    <td>{{ is_null($transaction->value_date) ? 'Non' : 'Oui' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
