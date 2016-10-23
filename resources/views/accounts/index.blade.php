@extends('layouts.front')

@section('title', 'Mes comptes')

@section('content')
<div class="ui grid">
    @include('menu.sidebar.profile')
    <div class="twelve wide column">
        @if ($user->accounts->count() > 0)
        <div class="ui segment">
            <h3 class="ui header">
                <i class="payment icon"></i>
                Mes comptes
            </h3>
            <div class="ui fluid cards">
                @foreach($user->accounts as $account)
                    <div class="card">
                        <div class="content">
                            <div class="header">
                                @if ($account->is_default)
                                <i class="star right active icon"></i>
                                @endif
                                {{$account->name}}
                            </div>
                            <div class="meta">
                                @amount($account->getBalance())
                            </div>
                            <div class="description">
                                {{$account->description}}
                            </div>
                        </div>
                        <a href="{{route('accounts.show', ['account' => $account->id])}}" class="ui bottom attached button">
                            <i class="settings icon"></i>
                            Gérer
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('accounts.create') }}" class="ui icon mini button" data-use-modal="true">
            <i class="add icon"></i>
            Ajouter un compte
        </a>
        @else
        <div class="ui info icon message">
            <i class="info icon"></i>
            {!! HTML::linkRoute('accounts.create', 'Ajouter un compte', [], ['data-use-modal' => 'true']) !!} &nbsp; et associez-y des budgets.
        </div>
        @endif
    </div>
</div>
@stop
