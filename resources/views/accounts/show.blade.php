@extends('layouts.front')

@section('title', 'Détails du compte')

@section('content')
    <div class="ui grid">
        @include('menu.sidebar.profile')
        <div class="twelve wide column">
            <div class="ui segment">
                <h3 class="ui header">
                    <i class="info circle icon"></i>
                    Détails du compte
                </h3>
                @include('accounts.edit')
            </div>
            <div class="ui segment">
                <h3 class="ui header">
                    <i class="tasks icon"></i>
                    Budgets
                </h3>
                @include('accounts.account_budgets.index')
            </div>
            @if (!$account->is_default)
            <div class="ui negative message">
                <p>Cliquez sur le bouton ci-dessous pour supprimer définitivement ce compte ainsi que l'ensemble des budgets et transactions qui lui sont associés.</p>
                {!! Form::open(['method' => 'delete', 'route' => ['accounts.destroy', $account->id], 'data-use-confirm' => 'true', 'data-confirm-modal-title' => 'Supprimer le compte', 'data-confirm-modal-message' => 'Souhaitez-vous définitivement supprimer ce compte ?']) !!}
                    <button type="submit" class="ui small red button">Supprimer le compte</button>
                {!! Form::close() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@stop
