@extends('layouts.front')

@section('title', 'Connexion')

@section('content')
<div class="columns large-6 large-centered">
    <div class="content">
        <h1>Connexion</h1>
        {!! Form::open(['method' => 'post', 'route' => 'login', 'data-ajax-form' => 'true']) !!}
            <div class="form-group">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::email('email', old('email'), ['id' => 'email']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Mot de passe') !!}
                {!! Form::password('password') !!}
            </div>
            <div class="form-group horizontal">
                {!! Form::checkbox('remember') !!}
                {!! Form::label('remember', 'Se souvenir de moi') !!}                
            </div>
            <div class="form-group">
                {!! Form::submit('Me connecter', array('class' => 'btn-base radius')) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
