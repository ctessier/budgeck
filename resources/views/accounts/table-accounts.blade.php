@if (count($accounts) > 0)
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Solde courant</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
        <tr>
            <td>{!! HTML::linkRoute('accounts.getAccount', $account->name, ['id' => $account->id]) !!}</td>
            <td>{{ $account->description }}</td>
            <td>{{ $account->getCurrentBalance() }}</td>
            <td class="align-center">{!! HTML::linkRoute('accounts.getEdit', 'Modifier', ['id' => $account->id], ['class' => 'btn-base radius no-margin', 'data-use-lightbox' => 'true']) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Vous n'avez pas encore de compte.</p>
@endif