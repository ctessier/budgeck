@extends('layouts.front')

@section('title', 'Suivi')

@section('content')

@include('menu.sidebar.accounts')
<div class="columns large-8">
    @include('accounts.month.budgets')
    @include('accounts.month.incomes')
</div>
@stop
