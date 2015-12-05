<div class="columns large-12">
    <div data-tab-id="incomes" class="tab-content content">
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
            <div class="actions"></div>
        </div>
        @endforeach
    </div>
</div>
