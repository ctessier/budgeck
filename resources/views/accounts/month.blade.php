@extends('layouts.front')

@section('content')
<div class="columns large-12">
    <h1>{{ $account->name }}</h1>
</div>
<div class="columns large-4">
    <ul class="tabs">
        <li class="active" data-tab-id="spendings">
            <a href="#">Dépenses</a>
        </li>
        <li data-tab-id="incomes">
            <a href="#">Revenus</a>
        </li>
    </ul>
</div>
<div class="columns large-8">
    <div data-tab-id="spendings" class="tab-content content active">
    </div>
</div>
@stop