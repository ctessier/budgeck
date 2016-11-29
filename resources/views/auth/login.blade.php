@extends('layouts.front')

@section('title', 'Connexion')

@section('content')
<div class="ui centered grid">
    <div class="sixteen wide smartphone ten wide tablet six wide computer column">
        <div class="ui segment">
            {!! Form::open(['method' => 'post', 'route' => 'login', 'class' => 'ui form' , 'data-ajax-form' => 'true']) !!}
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        {!! Form::email('email', old('email'), ['placeholder' => 'Adresse e-mail']) !!}
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        {!! Form::password('password', ['placeholder' => 'Mot de passe']) !!}
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox">
                        {!! Form::checkbox('remember', true, false, ['id' => 'remember']) !!}
                        {!! Form::label('remember', 'Se souvenir de moi') !!}
                    </div>
                </div>
                {!! Form::button('Connexion', ['type' => 'submit', 'class' => 'ui fluid button', 'data-form-submit' => 'true']) !!}
            {!! Form::close() !!}
        </div>
        <a href="{{ url('/password/email') }}">Mot de passe oublié ?</a>
    </div>
</div>
@stop
