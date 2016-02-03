<div class="content clearfix">
    @foreach ($incomes as $income)
    {{--*/ $amountIncome = $income->getTransactionsAmount() /*--}}
    {{--*/ $amountIncomeCredited = $income->getTransactionsAmountCredited() /*--}}
    <div class="income">
        <div class="title">{{$income->title}}</div>
        <div class="progress">
            <div class="progress-bar-container">
                <div class="progress-bar awaiting {{($amountIncome > $income->amount) ? 'full' : ''}}" style="width:{{min(100, ($amountIncome / $income->amount) * 100)}}%">
                    <div class="current-amount">
                        @if ($amountIncome > 0 && ($amountIncomeCredited == 0 || (($amountIncome-$amountIncomeCredited) / $income->amount)*100 > 5))
                        &euro; {{$amountIncome}}
                        @endif
                    </div>
                </div>
                <div class="progress-bar green" style="width:{{min(100, ($amountIncomeCredited / $income->amount) * 100)}}%">
                    <div class="current-amount">
                        @if ($amountIncomeCredited > 0)
                        &euro; {{$amountIncomeCredited}}
                        @endif
                    </div>
                </div>
            </div>
            <span class="amount">&euro; {{$income->amount}}</span>
        </div>                
        <div class="actions">
            <a href="" class="btn-tiny btn-grey radius">V</a>
            {!!HTML::linkRoute('incomes.getEdit', 'M', ['account_id' => $income->account->id, 'year' => $year, 'month' => $month, 'income_id' => $income->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
            {!!HTML::linkRoute('incomes.delete', 'S', ['budget_id' => $income->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
        </div>
    </div>
    @endforeach
    {!!HTML::linkRoute('incomes.getEdit', 'Ajouter un revenu', ['account_id' => $account_id, 'year' => $year, 'month' => $month], ['class' => 'btn-tiny radius', 'data-use-lightbox' => 'true'])!!}
</div>
