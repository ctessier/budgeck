@extends('layouts.front')

@section('title', 'Suivi')

@section('content')

@include('accounts.month.tabs')
@include('accounts.month.budgets')
@include('accounts.month.incomes')

@stop
