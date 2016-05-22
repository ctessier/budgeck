@extends('layouts.front')

@section('title', 'Mes comptes')

@section('content')
@include('menu.sidebar.profile')
<div class="columns large-8 small-12">
    <div class="alert">
        <p class="align-center">
            Créer un compte et associez-y des budgets.<br />
            {!! HTML::linkRoute('accounts.create', 'Ajouter un compte', [], ['class' => 'btn-base radius', 'data-use-lightbox' => 'true']) !!}
        </p>
    </div>
    @if ($user->accounts->count() > 0)
    <div class="content">
        <h3>Mes comptes</h3>
        <div class="list-accounts">
            @foreach($user->accounts as $account)
            <div class="account">
                {{--*/ $accountBalance = $account->getBalance() /*--}}
                {{--*/ $accountProjection = $account->getProjection(date('Y'), date('m')) /*--}}
                <span class="account-balance">
                    <span class="{{($accountBalance < 0) ? 'negative' : 'positive'}}">@amount($accountBalance)</span>
                    <span class="{{($accountProjection < 0) ? 'negative' : 'positive'}}">Prévision à la fin du mois : @amount($accountProjection)</span>
                </span>
                <span class="account-name">{{ $account->name }} {{ $account->is_default ? '(défaut)' : '' }}</span>
                <span class="account-description">{{ $account->description }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@stop
