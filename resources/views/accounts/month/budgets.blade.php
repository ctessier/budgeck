<div class="columns large-12">
    <div data-tab-id="budgets" class="tab-content content active clearfix">
        @foreach ($budgets as $budget)
        {{--*/ $amountSpent = $budget->getAmountSpent() /*--}}
        <div class="budget">
            <div class="title">{{$budget->title}}</div>
            <div class="progress">
                <div class="progress-bar-container">
                    <div class="progress-bar {{($amountSpent <= $budget->amount) ? 'green' : 'red'}}" style="width:{{min(100, ($amountSpent / $budget->amount) * 100)}}%">
                        <div class="current-amount">
                            @if ($amountSpent > 0)
                            &euro; {{$amountSpent}}
                            @endif
                        </div>
                    </div>
                </div>
                <span class="amount">&euro; {{$budget->amount}}</span>
            </div>                
            <div class="actions"></div>
        </div>
        @endforeach
    </div>
</div>
