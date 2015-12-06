@extends('layouts.lightbox')

@section('content')
@if ($isCreation)
{!! Form::open(['method' => 'post', 'route' => ['incomes.postSave', $account_id, $year, $month], 'data-ajax-form' => 'true']) !!}
@else
{!! Form::model($income, ['method' => 'post', 'route' => ['incomes.postSave', $account_id, $year, $month, $income->id], 'data-ajax-form' => 'true']) !!}
@endif
<div class="row">
    <div class="columns large-12">
        @if ($isCreation)
        <h3>Ajouter un revenu</h3>
        @else
        <h3>Revenu {{ $income->title }}</h3>
        @endif
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
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('account_id', 'Compte') !!}
            {!! Form::select('account_id', $user->getAccountsList()) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('month', 'Mois') !!}
            {!! Form::selectMonth('month', ($income == null) ? date('n') : $income->month) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('year', 'Année') !!}
            {!! Form::selectRange('year', date('Y') - 1, date('Y') + 1, ($income == null) ? date('Y') : $income->year) !!}
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
            {!! Form::label('expected_date', 'Date') !!}
            {!! Form::text('expected_date', null, ['placeholder' => 'Date...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <div class="form-group">
            {!! Form::label('category_id', 'Catégorie') !!}
            {!! Form::select('category_id', Budgeck\Category::getIncomeCategoriesList()) !!}
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
