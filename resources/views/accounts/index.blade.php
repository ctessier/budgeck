@extends('layouts.front')

@section('title', 'Mes comptes')

@section('content')
@include('menu.sidebar.profile')
<div class="columns large-8 small-12">
    <div class="alert">
        <p class="align-center">
            Créer un compte et ajoutez-y des budgets et des revenus.<br />Gérez ensuite vos transactions.<br />
            {!! HTML::linkRoute('accounts.getEdit', 'Ajouter un compte', null, ['class' => 'btn-base radius', 'data-use-lightbox' => 'true']) !!}
        </p>
    </div>
    @if (count($accounts) > 0)
    <div class="content">
        <h3>Mes comptes</h3>
        @include('accounts.list-accounts')
    </div>
    @endif
</div>
@stop
