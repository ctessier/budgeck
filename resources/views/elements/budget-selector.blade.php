<div id="budget-selector" class="ui search selection dropdown" data-budget-id="{{ (isset($transaction)) ? $transaction->budget_id : null }}" data-account-budget-id="{{ (isset($transaction) && isset($transaction->budget)) ? $transaction->budget->account_budget_id : null }}">
    {!! Form::hidden('budget_id') !!}
    <div class="default text">Sélectionner un budget</div>
    <i class="dropdown icon"></i>
    <div class="menu"></div>
</div>

<script>
    (function() {
        $('#budget-selector').budgetSelector('{{ route('api.budgets') }}');
    })();
</script>
