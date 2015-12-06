<div class="columns large-12">
    <div data-tab-id="budgets" class="tab-content content active clearfix">
        @foreach ($budgets as $budget)
        {{--*/ $amountSpent = $budget->getAmountSpent() /*--}}
        {{--*/ $amountSpentDebited = $budget->getAmountSpentDebited() /*--}}
        <div class="budget">
            <div class="title">{{$budget->title}}</div>
            <div class="progress">
                <div class="progress-bar-container">
                    <div class="progress-bar awaiting {{($amountSpent > $budget->amount) ? 'full' : ''}}" style="width:{{min(100, ($amountSpent / $budget->amount) * 100)}}%">
                        <div class="current-amount">
                            @if ($amountSpent > 0)
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
                @if ($budget->budget_type_id == Budgeck\BudgetType::SINGLE)
                <a href="" class="btn-tiny btn-grey radius">P</a>
                @endif
                @if ($budget->budget_type_id == Budgeck\BudgetType::MULTIPLE)
                <a href="" class="btn-tiny btn-grey radius">+</a>
                @endif
                {!!HTML::linkRoute('budgets.getEdit', 'M', ['account_id' => $account->id, 'year' => $year, 'month' => $month, 'budget_id' => $budget->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
                {!!HTML::linkRoute('budgets.delete', 'S', ['budget_id' => $budget->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
            </div>
        </div>
        @endforeach
        {!!HTML::linkRoute('budgets.getEdit', 'Ajouter un budget', ['account_id' => $account->id, 'year' => $year, 'month' => $month], ['class' => 'btn-base radius', 'data-use-lightbox' => 'true'])!!}
    </div>
</div>
