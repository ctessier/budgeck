<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('title', 'Titre') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('title', null, ['placeholder' => 'Titre de l\'opération']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('amount', 'Montant') !!}
    </div>
    <div class="six wide column field">
        <div class="ui right labeled input">
            {!! Form::text('amount', null, ['placeholder' => '12.34']) !!}
            <div class="ui basic label">
                &euro;
            </div>
        </div>
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('Jour') !!}
    </div>
    <div class="six wide column field">
        {!! Form::selectRange('day', 1, 31, isset($recurrent_transaction) ? $recurrent_transaction->day : null, ['id' => 'day-selector', 'class' => 'ui search dropdown']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('account_budget_id', 'Budget') !!}
    </div>
    <div class="six wide column field">
        {{--*/ $accountBudgetArray = $account->account_budgets; /*--}}
        @include('elements.account-budget-selector')
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('category_id', 'Catégorie') !!}
    </div>
    <div class="six wide column field">
        {{--*/ $categoryFieldName = "category_id" /*--}}
        {{--*/ $categoryArray = Budgeck\Models\Category::getList(Budgeck\Models\CategoryType::EXPENSE) /*--}}
        @include('elements.category-selector')
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('next_month', 'Compter pour le mois suivant') !!}
    </div>
    <div class="six wide column field">
        <div class="ui toggle checkbox">
            {!! Form::checkbox('next_month', true, false, ['id' => 'next_month']) !!}
            {!! Form::label('', '&nbsp;') !!}
        </div>
    </div>
</div>

{!! Form::hidden('transaction_type_id', \Budgeck\Models\TransactionType::EXPENSE) !!}

<script>
    $('#day-selector').dropdown();
</script>
