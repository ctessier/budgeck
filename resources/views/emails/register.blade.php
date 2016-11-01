@extends('layouts.email')

@section('content')
    <p>Bonjour {{ $firstname }},</p>
    <p>Un compte vous a été créé sur Budgeck, l'application en ligne de gestion et de suivi mensuel de vos budgets.</p>
    <p>Pour accéder à l'application, cliquez sur le lien ci-dessous et connectez-vous à l'aide des identifiants suivants :</p>
    <p>
        <strong>Adresse e-mail :</strong> {{ $email }}<br />
        <strong>Mot de passe :</strong> {{ $password }}
    </p>
    <p><a class="button" href="{{ url() }}">Accéder à Budgeck</a></p>
@stop
