{{--*/ $budgets = $account->account_budgets /*--}}
@if ($budgets->count() > 0)
<table class="ui table">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Montant</th>
            <th style="width:5%"></th>
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
            <td>
                <div class="ui icon top left pointing dropdown mini settings-icon">
                    <i class="angle down icon"></i>
                    <div class="menu">
                        {!! HTML::linkRoute('accounts.account_budgets.edit', 'Modifier', ['accounts' => $account->id, 'budgets' => $account_budget->id], ['class' => 'item', 'data-use-modal' => 'true']) !!}
                        {!! Form::open(['method' => 'delete', 'route' => ['accounts.account_budgets.destroy', $account_budget->account_id, $account_budget->id], 'class' => 'item', 'data-use-confirm' => 'true', 'data-confirm-modal-title' => 'Supprimer le budget : ' . $account_budget->title, 'data-confirm-modal-message' => 'Souhaitez-vous définitivement supprimer ce budget ? Cela affectera seulement les budgets des mois futurs.']) !!}
                            <div type="submit">Supprimer</div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>{{$budgets->count()}} budget(s)</th>
            <th></th>
            <th>@amount($budgetsTotalAmount)</th>
            <th></th>
        </tr>
    </tfoot>
</table>
@else
<p>Ajouter des budgets pour commencer à gérer les finances de ce compte.</p>
@endif

<a href="{{ route('accounts.account_budgets.create', ['accounts' => $account->id]) }}" class="ui icon mini button" data-use-modal="true">
    <i class="add icon"></i>
    Ajouter un budget
</a>
