@extends('layouts/front')

@section('title', 'Tableau de bord')

@section('content')
<div class="columns large-7 small-12">
    <div class="content">
        <h1>Tableau de bord</h1>
        <p>Bienvenue sur votre tableau de bord {{$user->firstname}} !</p>
    </div>
</div>
<div class="columns large-5 small-12">
    <div class="content">
        <h3>Paiements en attente</h3>      
        <p class="info">Vous n'avez aucun paiement en attente.</p>
    </div>
    <div class="content">
        <h3>Paiements en attente</h3>      
        <p class="info">Vous n'avez aucun paiement en attente.</p>
    </div>
</div>
@stop
