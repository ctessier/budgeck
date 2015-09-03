@extends('layouts.lightbox')

@section('content')
<div class="row">
    <div class="columns large-12">
        @if ($isCreation)
        <h3>Ajouter un compte</h3>
        @else
        <h3>{{ $account->name }}</h3>
        @endif
        @if ($isCreation)
        {!! Form::open(['method' => 'post', 'route' => ['accounts.postCreate', null], 'data-ajax-form' => 'true']) !!}
        @else
        {!! Form::model($account, ['method' => 'post', 'route' => ['accounts.postCreate', $account->id], 'data-ajax-form' => 'true']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['placeholder' => 'Nom du compte...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::text('description', null, ['placeholder' => 'Description...']) !!}
        </div>
        <div class="form-group">
            @if ($isCreation)
            {!! Form::submit('Créer le compte', ['class' => 'btn-base radius']) !!}
            @else
            {!! Form::submit('Sauvegarder', ['class' => 'btn-base radius']) !!}
            @endif
            <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop