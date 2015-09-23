@extends('layouts.front')

@section('title', 'Mes comptes')

@section('content')
@include('accounts.sidebar')
<div class="columns large-8 small-12">
    <div class="content cf">
        <h3>Mes comptes</h3>
        @include('accounts.table-accounts')
        {!! HTML::linkRoute('accounts.getEdit', 'Ajouter un compte', null, ['class' => 'btn-base radius right', 'data-use-lightbox' => 'true']) !!}
    </div>
</div>
@stop
