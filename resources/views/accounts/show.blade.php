@extends('layouts.front')

@section('title', 'Détails du compte')

@section('content')
@include('menu.sidebar.profile')
<div class="columns large-8 small-12">
    <div class="content">
        <h3>Détails du compte</h3>
        @include('accounts.edit')
    </div>
    <div class="content">
        <h3>Budgets</h3>
        {!! HTML::linkRoute('accounts.account_budgets.create', 'Ajouter un budget', ['accounts' => $account->id], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true']) !!}
        @include('accounts.account_budgets.index')
    </div>
    <div class="content">
        <h3>Dépenses récurrentes</h3>
        <p>Cette fonctionnalité sera disponible prochainement.</p>
    </div>
    <div class="content">
        <h3>Supprimer le compte</h3>
        <p>Cliquez sur le bouton ci-dessous pour supprimer définitivement ce compte ainsi que l'ensemble des éléments qui lui sont associés.</p>
        {!! Form::open(['method' => 'delete', 'route' => ['accounts.destroy', $account->id], 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer ce compte ?']) !!}
            <a class="btn-tiny btn-red radius" data-form-submit="true">Supprimer le compte</a>
        {!! Form::close() !!}
    </div>
</div>
@stop
