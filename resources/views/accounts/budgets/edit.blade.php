@extends('layouts.lightbox')

@section('content')
    <div class="row">
        <div class="columns large-12">
            <h3>Budget</h3>
        </div>
    </div>
    {!! Form::model($budget, ['method' => 'put', 'route' => ['accounts.budgets.update', $current_account->id, $budget->id], 'data-ajax-form' => 'true']) !!}
    @include('accounts.budgets.form')
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
