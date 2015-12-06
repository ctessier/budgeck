@extends('layouts/front')

@section('title', 'Tableau de bord')

@section('content')
<div class="columns large-7 small-12">
    <div class="content">
        @foreach ($user->accounts as $account)
        {!! HTML::linkRoute('accounts.month', 'Suivi du mois en cours pour ' . $account->name, ['account_id' => $account->id, 'month' => date('m'), 'year' => date('Y')], ['class' => 'btn-base radius']) !!}
        @endforeach
    </div>
</div>
<div class="columns large-5 small-12">
    <div class="content">
        <h3>Paiements en attente</h3>      
        <p class="info">Vous n'avez aucun paiement en attente.</p>
    </div>
    <div class="content">
        <h3>Revenus en attente</h3>      
        <p class="info">Vous n'avez aucun revenu en attente.</p>
    </div>
</div>
@stop
