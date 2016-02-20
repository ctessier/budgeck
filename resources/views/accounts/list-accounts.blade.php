<div class="list-accounts">
    @foreach ($accounts as $account)
    <div class="account">
        <a href="{{route('accounts.getAccount', ['id' => $account->id])}}">
            {{--*/ $accountBalance = $account->getCurrentBalance() /*--}}
            {{--*/ $accountLeft = $account->getLeftOvers() /*--}}
            <span class="account-balance">
                <span class="{{($accountBalance < 0) ? 'negative' : 'positive'}}">&euro; {{$accountBalance}}</span>
                <span class="{{($accountLeft < 0) ? 'negative' : 'positive'}}">&euro; {{$accountLeft}}</span>
            </span>
            <span class="account-name">{{$account->name}}</span>
            <span class="account-description">{{$account->description}}</span>
        </a>
    </div>
    @endforeach
</div>
