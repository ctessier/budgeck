@extends('layouts.front')

@section('title', 'Mon profil')

@section('content')
<div class="ui grid">
    @include('menu.sidebar.profile')
    <div class="twelve wide column">
        <div class="ui segment">
            <h3 class="ui header">
                <i class="user icon"></i>
                Mes informations personnelles
            </h3>
            {!! Form::model($user, ['method' => 'put', 'route' => 'profile.update', 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
                <div class="ui grid inline fields">
                    <div class="three wide column field">
                        {!! Form::label('firstname', 'Prénom') !!}
                    </div>
                    <div class="six wide column field">
                        {!! Form::text('firstname') !!}
                    </div>
                </div>
                <div class="ui grid inline fields">
                    <div class="three wide column field">
                        {!! Form::label('lastname', 'Nom') !!}
                    </div>
                    <div class="six wide column field">
                        {!! Form::text('lastname') !!}
                    </div>
                </div>
                <div class="ui grid inline fields">
                    <div class="three wide column field">
                        {!! Form::label('email', 'E-mail') !!}
                    </div>
                    <div class="six wide column field">
                        {!! Form::text('email') !!}
                    </div>
                </div>
                {!! Form::button('Sauvegarder', ['type' => 'submit', 'class' => 'ui blue button', 'data-form-submit' => 'true']) !!}
            {!! Form::close() !!}
        </div>
        <div class="ui segment">
            <h3 class="ui header">
                <i class="lock icon"></i>
                Mon mot de passe
            </h3>
            {!! Form::open(['method' => 'put', 'route' => 'profile.password.update', 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
                <div class="ui grid inline fields">
                    <div class="three wide column field">
                        {!! Form::label('oldpassword', 'Ancien mot de passe') !!}
                    </div>
                    <div class="six wide column field">
                        {!! Form::password('oldpassword', ['autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="ui grid inline fields">
                    <div class="three wide column field">
                        {!! Form::label('newpassword', 'Nouveau mot de passe') !!}
                    </div>
                    <div class="six wide column field">
                        {!! Form::password('newpassword') !!}
                    </div>
                </div>
                <div class="ui grid inline fields">
                    <div class="three wide column field">
                        {!! Form::label('newpassword_confirmation', 'Confirmation') !!}
                    </div>
                    <div class="six wide column field">
                        {!! Form::password('newpassword_confirmation') !!}
                    </div>
                </div>
                {!! Form::button('Sauvegarder', ['type' => 'submit', 'class' => 'ui blue button', 'data-form-submit' => 'true']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop


