@extends('layouts.lightbox')

@section('content')
    <div class="row">
        <div class="columns large-12">
            <h3>Ajouter un compte</h3>
            {!! Form::open(['method' => 'post', 'route' => ['accounts.store', null], 'data-ajax-form' => 'true']) !!}

            @include('accounts.form')

            <div class="form-group">
                <a class="btn-base btn-grey radius" data-lightbox-dismiss="true">Annuler</a>
                <a class="btn-base radius" data-form-submit="true">Sauvegarder</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
