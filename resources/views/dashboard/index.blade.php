@extends('layouts/front')

@section('title', 'Tableau de bord')

@section('content')
<div class="columns large-7 small-12">
    <div class="content">
        {!! HTML::linkRoute('accounts.month', 'Suivi du mois en cours', ['id' => 1, 'month' => 11, 'year' => 2015], ['class' => 'btn-base radius']) !!}
    </div>
</div>
<div class="columns large-5 small-12">
    <div class="content">
        <h3>Paiements en attente</h3>      
        <p class="info">Vous n'avez aucun paiement en attente.</p>
    </div>
</div>
@stop
