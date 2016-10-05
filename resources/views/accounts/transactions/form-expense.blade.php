<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('title', 'Titre') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('title', null, ['placeholder' => 'Titre de la dépense']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('amount', 'Montant') !!}
    </div>
    <div class="six wide column field">
        <div class="ui right labeled input">
            {!! Form::text('amount', null, ['placeholder' => '0.00']) !!}
            <div class="ui basic label">
                &euro;
            </div>
        </div>
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('Mois') !!}
    </div>
    <div class="six wide column field">
        @include('elements.month-selector')
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('budget_id', 'Budget') !!}
    </div>
    <div class="six wide column field">
        {!! Form::select('budget_id', [], null, ['data-budgets-list' => 'true', 'data-account-budget-id' => isset($transaction) ? $transaction->budget_id : null, 'data-budget-id' => isset($transaction) ? $transaction->budget_id : null]) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('transaction_date', 'Date de transaction') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('transaction_date', isset($transaction) ? $transaction->transaction_date->format('Y-m-d') : null, ['id' => 'datepicker-transaction-date', 'placeholder' => 'Date de transaction...']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('value_date', 'Date de valeur') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('value_date', isset($transaction) && $transaction->value_date ? $transaction->value_date->format('Y-m-d') : null, ['id' => 'datepicker-value-date', 'placeholder' => 'Date de valeur...']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('category_id', 'Catégorie') !!}
    </div>
    <div class="six wide column field">
        {{--*/ $categoryArray = Budgeck\Models\Category::getList(Budgeck\Models\CategoryType::EXPENSE) /*--}}
        {{--*/ $categoryFieldName = "category_id" /*--}}
        @include('elements.category-selector')
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('comment', 'Commentaire') !!}
    </div>
    <div class="six wide column field">
        {!! Form::textarea('comment') !!}
    </div>
</div>

{!! Form::hidden('transaction_type_id', \Budgeck\Models\TransactionType::EXPENSE) !!}
