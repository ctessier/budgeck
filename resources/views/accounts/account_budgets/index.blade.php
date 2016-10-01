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
            <!--<td class="align-center">
                {!! HTML::linkRoute('accounts.account_budgets.edit', 'Modifier', ['accounts' => $account->id, 'budgets' => $account_budget->id], ['class' => 'ui mini button', 'data-use-lightbox' => 'true']) !!}
                {!! Form::open(['method' => 'delete', 'route' => ['accounts.account_budgets.destroy', $account->id, $account_budget->id], 'style' => 'display:inline;', 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer ce budget ? Cela affectera seulement les budgets des mois futurs.']) !!}
                    <a class="ui mini button" data-form-submit="true">Supprimer</a>
                {!! Form::close() !!}
            </td>-->
            <td>
                <div class="ui icon top left pointing dropdown mini settings-icon" style="display:none">
                    <i class="settings icon"></i>
                    <div class="menu">
                        <div class="item">Modifier</div>
                        <div class="item">Supprimer</div>
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

<a href="{{ route('accounts.account_budgets.create', ['accounts' => $account->id]) }}" class="ui icon mini button" data-use-lightbox="true">
    <i class="add icon"></i>
    Ajouter un budget
</a>

@else
<p>Ajouter des budgets pour commencer à gérer les finances de ce compte.</p>
@endif

<script>
    $('.dropdown').dropdown();
    $('tr').hover(function() {
        $(this).find('td .settings-icon').show();
    });
    $('tr').mouseleave(function() {
        $(this).find('td .settings-icon').hide();
    });
</script>
