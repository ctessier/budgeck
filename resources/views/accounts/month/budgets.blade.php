<div class="columns large-8">
    <div data-tab-id="budgets" class="tab-content content active">
        @foreach ($budgets as $budget)
        {{--*/ $amountSpent = $budget->getAmountSpent() /*--}}
        <div class="budget">
            <span class="title">{{$budget->title}}</span>
            <div class="progress-bar-container">
                <div class="progress-bar" style="width:{{($amountSpent / $budget->amount) * 100}}%">
                    @if ($amountSpent > 0)
                    <span class="spent">{{$amountSpent}}</span>
                    @endif
                </div>
                <span class="amount">{{$budget->amount}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
