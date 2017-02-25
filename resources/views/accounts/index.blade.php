@extends('layouts.front')

@section('title', 'Mes comptes')

@section('content')
<div class="ui stackable grid">
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
                    {{--*/ $accountBalance = $account->getBalance() /*--}}
                    <div class="{{ $accountBalance < 0 ? 'red' : '' }} card">
                        <div class="content">
                            <div class="header">
                                <div class="right floated">
                                    @if ($account->is_default)
                                        <i class="star right active icon" style="cursor: default;"></i>
                                    @else
                                        {!! Form::open(['method' => 'post', 'route' => ['accounts.default', $account->id], 'style' => 'display: inline;']) !!}
                                        <i class="star right icon" onclick="$(this).parent('form').submit();"></i>
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                                {{ $account->name }}
                            </div>
                            <div class="meta">
                                {{ $account->description }}
                            </div>
                        </div>
                        <div class="extra content">
                            {{--*/ $expectedBalance = $account->getExpectedBalance() /*--}}
                            @if ($expectedBalance >= 0)
                            <i class="check green icon"></i>
                            @else
                            <i class="warning sign red icon"></i>
                            @endif
                            Prévision en fin de mois : @amount($account->getExpectedBalance())
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
