@extends('layouts.front')

@section('title', 'Mon profil')

@section('content')
<div class="columns large-4">
    <ul class="tabs">
        <li class="active" data-tab-id="profile">
            <a href="#">Mon profil</a>
        </li>
        <li data-tab-id="accounts">
            <a href="#">Mes comptes</a>
        </li>
        <li data-tab-id="parameters">
            <a href="#">Mes paramètres</a>
        </li>
    </ul>
</div>
<div class="columns large-8">
    <div data-tab-id="profile" class="tab-content content active">   
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
                {!! Form::submit('Mettre à jour', array('class' => 'btn-base radius right')) !!}
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
                    {!! Form::label('newpasswordconfirm', 'Confirmation') !!}
                </div>                
            </div>
            <div class="columns large-8">
                <div class="form-group">
                    {!! Form::password('newpasswordconfirm') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="columns large-12">
                {!! Form::submit('Changer mon mot de passe', array('class' => 'btn-base radius right')) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop