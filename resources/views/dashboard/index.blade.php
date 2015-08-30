@extends('layouts/front')

@section('title', 'Tableau de bord')

@section('content')
<div class="columns small-12">
    <div class="content">
        <h1>Tableau de bord</h1>
        <p>Bienvenue sur votre tableau de bord {{$user->firstname}} !</p>
    </div>
</div>
@stop
