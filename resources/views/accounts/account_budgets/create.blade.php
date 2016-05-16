@extends('layouts.lightbox')

@section('content')
    <div class="row">
        <div class="columns large-12">
            <h3>Nouveau budget pour {{ $account->name }}</h3>
        </div>
    </div>
    {!! Form::open(['method' => 'post', 'route' => ['accounts.account_budgets.store', $account->id], 'data-ajax-form' => 'true']) !!}
    @include('accounts.account_budgets.form')
    <div class="row">
        <div class="columns large-12">
            <div class="form-group">
                <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
                <a class="btn-base radius" data-form-submit="true" >Sauvegarder</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
