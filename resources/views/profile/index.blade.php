@extends('layouts.front')

@section('title', 'Mon profil')

@section('content')
@include('profile.sidebar')
<div class="columns large-8">
    <div class="content">   
        <h3>Mes informations personnelles</h3>
        {!! Form::model($user, ['method' => 'post', 'route' => 'profile.save', 'class' => 'horizontal', 'data-ajax-form' => 'true']) !!}
        <div class="row">
            <div class="columns large-3">
                <div class="form-group">
                    {!! Form::label('email', 'E-mail') !!}
                </div>                
            </div>
            <div class="columns large-9">
                <div class="form-group">
                    {!! Form::text('email') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-3">
                <div class="form-group">
                    {!! Form::label('firstname', 'Prénom') !!}
                </div>                
            </div>
            <div class="columns large-9">
                <div class="form-group">
                    {!! Form::text('firstname') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-3">
                <div class="form-group">
                    {!! Form::label('lastname', 'Nom de famille') !!}
                </div>                
            </div>
            <div class="columns large-9">
                <div class="form-group">
                    {!! Form::text('lastname') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-12">
                {!! Form::submit('Mettre à jour', ['class' => 'btn-base radius right']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <h3>Mon mot de passe</h3>
        {!! Form::open(['method' => 'post', 'route' => 'profile.savepassword', 'class' => 'horizontal', 'data-ajax-form' => 'true']) !!}
        <div class="row">
            <div class="columns large-4">
                <div class="form-group">
                    {!! Form::label('oldpassword', 'Ancien mot de passe') !!}
                </div>                
            </div>
            <div class="columns large-8">
                <div class="form-group">
                    {!! Form::password('oldpassword') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-4">
                <div class="form-group">
                    {!! Form::label('newpassword', 'Nouveau mot de passe') !!}
                </div>                
            </div>
            <div class="columns large-8">
                <div class="form-group">
                    {!! Form::password('newpassword') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-4">
                <div class="form-group">
                    {!! Form::label('newpassword_confirmation', 'Confirmation') !!}
                </div>                
            </div>
            <div class="columns large-8">
                <div class="form-group">
                    {!! Form::password('newpassword_confirmation') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-12">
                {!! Form::submit('Changer mon mot de passe', ['class' => 'btn-base radius right']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop