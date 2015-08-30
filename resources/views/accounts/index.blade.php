@extends('layouts.front')

@section('title', 'Mes comptes')

@section('content')
<div class="columns small-12">
    <div class="content">
        <h1>Mes comptes</h1>
        @foreach ($accounts as $account)
        {{$account->name}}<br />
        @endforeach
    </div>
</div>
@stop
