{{--*/ $budgets = $account->account_budgets /*--}}
@if ($budgets->count() > 0)
<table class="ui table">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Montant</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{--*/ $budgetsTotalAmount = 0 /*--}}
        @foreach ($budgets as $account_budget)
        {{--*/ $budgetsTotalAmount += $account_budget->amount /*--}}
        <tr>
            <td>{{ $account_budget->title }}</td>
            <td>{{ $account_budget->description }}</td>
            <td>@amount($account_budget->amount)</td>
            <td class="align-center">
                {!! HTML::linkRoute('accounts.account_budgets.edit', 'Modifier', ['accounts' => $account->id, 'budgets' => $account_budget->id], ['class' => 'ui mini button', 'data-use-lightbox' => 'true']) !!}
                {!! Form::open(['method' => 'delete', 'route' => ['accounts.account_budgets.destroy', $account->id, $account_budget->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer ce budget ? Cela affectera seulement les budgets des mois futurs.']) !!}
                    <a class="ui mini button" data-form-submit="true">Supprimer</a>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>{{$budgets->count()}} budget(s)</th>
            <th></th>
            <th>@amount($budgetsTotalAmount)</th>
            <th>{!! HTML::linkRoute('accounts.account_budgets.create', 'Ajouter un budget', ['accounts' => $account->id], ['class' => 'ui mini button', 'data-use-lightbox' => 'true']) !!}</th>
        </tr>
    </tfoot>
</table>
@else
<p>Ajouter des budgets pour commencer à gérer les finances de ce compte.</p>
@endif
