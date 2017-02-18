<div id="account-budget-selector" class="ui dropdown selection">
    {!! Form::hidden('account_budget_id') !!}
    <span class="default text">Sélectionner un budget</span>
    <i class="dropdown icon"></i>
    <div class="menu">
        @foreach ($accountBudgetArray as $budget)
            <div class="item" data-value="{{ $budget->id }}">
                <span class="text">{{ $budget->title }}</span>
            </div>
        @endforeach
    </div>
</div>

<script>
    $('#account-budget-selector').accountBudgetSelector();
</script>
