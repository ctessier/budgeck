{{--*/ $accountBalance = $account->getBalance() /*--}}
<div class="{{ $accountBalance < 0 ? 'red' : '' }} card">
    <div class="content">
        <div class="header">
            @if (Route::currentRouteNamed('accounts.index'))
                <div class="right floated">
                    @if ($account->is_default)
                        <i class="star right active icon" style="cursor: default;"></i>
                    @else
                        {!! Form::open(['method' => 'post', 'route' => ['accounts.default', $account->id], 'style' => 'display: inline;']) !!}
                        <i class="star right icon" onclick="$(this).parent('form').submit();"></i>
                        {!! Form::close() !!}
                    @endif
                </div>
            @endif
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
    @if (Route::currentRouteNamed('accounts.index'))
        <a href="{{route('accounts.show', ['account' => $account->id])}}" class="ui bottom attached button">
            <i class="settings icon"></i>
            Gérer
        </a>
    @endif
</div>
