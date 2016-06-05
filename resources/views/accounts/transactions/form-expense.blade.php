<div class="row">
    <div class="columns large-12">
        <h3>Dépense</h3>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('title', 'Titre') !!}
            {!! Form::text('title', null, ['placeholder' => 'Titre...']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('amount', 'Montant') !!}
            {!! Form::text('amount', null, ['placeholder' => 'Montant...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        @include('elements.month-selector')
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('budget_id', 'Budget') !!}
            {!! Form::select('budget_id', [], null, ['data-budgets-list' => 'true', 'data-account-budget-id' => isset($transaction) ? $transaction->budget_id : null, 'data-budget-id' => isset($transaction) ? $transaction->budget_id : null]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('transaction_date', 'Date de transaction') !!}
            {!! Form::text('transaction_date', isset($transaction) ? $transaction->transaction_date->format('Y-m-d') : null, ['placeholder' => 'Date de transaction...', 'class' => 'datepicker']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('value_date', 'Date de valeur') !!}
            {!! Form::text('value_date', isset($transaction) && $transaction->value_date ? $transaction->value_date->format('Y-m-d') : null, ['placeholder' => 'Date de valeur...', 'class' => 'datepicker']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('comment', 'Commentaire') !!}
            {!! Form::textarea('comment') !!}
        </div>
    </div>
    <div class="columns large-6">
        @include('elements.category-selector')
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
            <a class="btn-base radius" data-form-submit="true">Sauvegarder</a>
        </div>
    </div>
</div>
{!! Form::hidden('transaction_type_id', \Budgeck\Models\TransactionType::EXPENSE) !!}
