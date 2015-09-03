@extends('layouts.front')

@section('title', $account->description)

@section('content')
@include('accounts.sidebar')
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