@extends('layouts.front')

@section('title', 'Détails du compte')

@section('content')
@include('menu.sidebar.profile')
<div class="columns large-8">
    <div class="content">
        
        <h2>{{ $account->name }}</h2>
        <h3>Budgets</h3>
        <div class="cf">
        @include('accounts.table-budgets')
        </div>
        <h3>Revenus</h3>
        <div class="cf">
        @include('accounts.table-incomes')
        </div>
    </div>
</div>
@stop
