@extends('layouts.lightbox')

@section('content')
@if ($isCreation)
{!! Form::open(['method' => 'post', 'route' => ['accounts.incomes.postSave', $account->id], 'data-ajax-form' => 'true']) !!}
@else
{!! Form::model($account_income, ['method' => 'post', 'route' => ['accounts.incomes.postSave', $account->id, $account_income->id], 'data-ajax-form' => 'true']) !!}
@endif
<div class="row">
    <div class="columns large-12">
        <h3>Revenu pour {{ $account->name }}</h3>        
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('title', 'Titre') !!}
            {!! Form::text('title', null, ['placeholder' => 'Titre...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::text('description', null, ['placeholder' => 'Description...']) !!}
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
            {!! Form::label('day', 'Jour') !!}
            {!! Form::text('day', null, ['placeholder' => 'Jour...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('category_id', 'Catégorie par défaut') !!}
            {!! Form::select('category_id', $listCategories) !!}
        </div>
    </div>    
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            @if ($isCreation)
            {!! Form::submit('Créer le revenu', ['class' => 'btn-base radius']) !!}
            @else
            {!! Form::submit('Sauvegarder', ['class' => 'btn-base radius']) !!}
            @endif
            <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
