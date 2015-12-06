<div class="columns large-12">
    <div data-tab-id="incomes" class="tab-content content clearfix">
        @foreach ($incomes as $income)
        <div class="income">
            <div class="title">{{$income->title}}</div>
            <div class="progress">
                <div class="progress-bar-container">
                    <div class="progress-bar green" style="width:{{($income->credit_date !== null) ? '100' : '0'}}%">                        
                    </div>
                </div>
                <span class="amount">&euro; {{$income->amount}}</span>
            </div>                
            <div class="actions">
                <a href="" class="btn-tiny btn-grey radius">V</a>
                {!!HTML::linkRoute('incomes.getEdit', 'M', ['account_id' => $account->id, 'year' => $year, 'month' => $month, 'income_id' => $income->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
                {!!HTML::linkRoute('incomes.delete', 'S', ['budget_id' => $income->id], ['class' => 'btn-tiny btn-grey radius', 'data-use-lightbox' => 'true'])!!}
            </div>
        </div>
        @endforeach
        {!!HTML::linkRoute('incomes.getEdit', 'Ajouter un revenu', ['account_id' => $account->id, 'year' => $year, 'month' => $month], ['class' => 'btn-base radius', 'data-use-lightbox' => 'true'])!!}
    </div>
</div>
