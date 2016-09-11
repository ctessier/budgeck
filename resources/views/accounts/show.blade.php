@extends('layouts.front')

@section('title', 'Détails du compte')

@section('content')
    <div class="ui grid">
        @include('menu.sidebar.profile')
        <div class="twelve wide column">
            <div class="ui segment">
                <h3>Détails du compte</h3>
                @include('accounts.edit')
            </div>
            <div class="ui segment">
                <h3>Budgets</h3>
                @include('accounts.account_budgets.index')
            </div>
            <div class="ui segment">
                <h3>Dépenses récurrentes</h3>
                <p>Cette fonctionnalité sera disponible prochainement.</p>
            </div>
            <div class="ui negative message">
                <p>Cliquez sur le bouton ci-dessous pour supprimer définitivement ce compte ainsi que l'ensemble des budgets et transactions qui lui sont associés.</p>
                {!! Form::open(['method' => 'delete', 'route' => ['accounts.destroy', $account->id], 'data-use-confirm' => 'true', 'data-confirm-message' => 'Souhaitez-vous définitivement supprimer ce compte ?']) !!}
                    <a class="ui small red button" data-form-submit="true">Supprimer le compte</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
