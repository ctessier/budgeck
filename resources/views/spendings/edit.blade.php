@extends('layouts.lightbox')

@section('content')
@if ($isCreation)
{!! Form::open(['method' => 'post', 'route' => ['budgets.spendings.postSave', $account_id, $year, $month, $budget_id], 'data-ajax-form' => 'true']) !!}
@else
{!! Form::model($spending, ['method' => 'post', 'route' => ['budgets.spendings.postSave', $account_id, $year, $month, $budget_id, $spending->id], 'data-ajax-form' => 'true']) !!}
@endif
<div class="row">
    <div class="columns large-12">
        @if ($isCreation)
        <h3>Nouvelle dépense</h3>
        @else
        <h3>Modifier une dépense</h3>
        @endif
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', null, ['placeholder' => 'Description...']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('budget_id', 'Budget') !!}
            {!! Form::select('budget_id', Budgeck\Budget::getListFromAccountYearMonth($account_id, $year, $month), ($spending == null) ? $budget_id : $spending->budget_id) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('amount', 'Montant') !!}
            {!! Form::text('amount', null, ['placeholder' => 'Montant...']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('payment_date', 'Date de paiement') !!}
            {!! Form::text('payment_date', null, ['placeholder' => 'Date de paiement...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('category_id', 'Catégorie') !!}
            {!! Form::select('category_id', Budgeck\Category::getSpendingCategoriesList()) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('debit_date', 'Date de débit') !!}
            {!! Form::text('debit_date', null, ['placeholder' => 'Date de débit...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('payment_method_id', 'Méthode de paiement') !!}
            {!! Form::select('payment_method_id', Budgeck\PaymentMethod::lists('name', 'id')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('comment', 'Commentaire') !!}
            {!! Form::textarea('comment', null, ['placeholder' => 'Commentaire...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            @if ($isCreation)
            {!! Form::submit('Créer la dépense', ['class' => 'btn-base radius']) !!}
            @else
            {!! Form::submit('Sauvegarder', ['class' => 'btn-base radius']) !!}
            @endif
            <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop