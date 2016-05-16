<div class="content clearfix">
    @foreach ($budgets as $budget)
    {{--*/ $amountSpent = $budget->getAmountSpent() /*--}}
    {{--*/ $amountSpentDebited = $budget->getAmountSpentDebited() /*--}}
    <div class="budget">
        <div class="title">{{$budget->title}}</div>
        <div class="progress">
            <div class="progress-bar-container">
                <div class="progress-bar awaiting {{($amountSpent > $budget->amount) ? 'full' : ''}}" style="width:{{min(100, ($amountSpent / $budget->amount) * 100)}}%">
                    <div class="current-amount">
                        @if ($amountSpent > 0 && ($amountSpentDebited == 0 || (($amountSpent-$amountSpentDebited) / $budget->amount)*100 > 5))
                        &euro; {{$amountSpent}}
                        @endif
                    </div>
                </div>
                <div class="progress-bar {{($amountSpentDebited <= $budget->amount) ? 'green' : 'red'}}" style="width:{{min(100, ($amountSpentDebited / $budget->amount) * 100)}}%">
                    <div class="current-amount">
                        @if ($amountSpentDebited > 0)
                        &euro; {{$amountSpentDebited}}
                        @endif
                    </div>
                </div>
            </div>
            <span class="amount">&euro; {{$budget->amount}}</span>
        </div>                
        <div class="actions">
            {!!HTML::linkRoute('transactions.getEdit', '+', ['transaction_id' => null, 'budget_id' => $budget->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
            {!!HTML::linkRoute('budgets.getEdit', 'M', ['account_id' => $budget->account->id, 'year' => $year, 'month' => $month, 'budget_id' => $budget->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
        </div>
    </div>
    @endforeach
    {!!HTML::linkRoute('budgets.getEdit', 'Ajouter un budget', ['account_id' => $account_id, 'year' => $year, 'month' => $month], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true'])!!}
</div>
