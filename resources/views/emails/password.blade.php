@extends('layouts.email')

@section('content')
    <p>Une demande réinitialisation de mot de passe a été demandée pour votre compte.</p>
    <p>Si vous êtes à l'initiative de cette demande, cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe.<br />Sinon, merci d'ignorer ce message.</p>
    <p><a class="button" href="{{ url('password/reset/'.$token) }}">Réinitialiser mon mot de passe</a></p>
@stop
