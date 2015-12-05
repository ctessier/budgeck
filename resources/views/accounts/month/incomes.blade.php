<div class="columns large-8">
    <div data-tab-id="incomes" class="tab-content content">
        @foreach ($incomes as $income)
        <div class="income">
            <span class="title">{{$income->title}}</span>
            <div class="progress-bar-container">
                <div class="progress-bar" style="width:100%">
                    <span class="spent"></span>
                </div>
                <span class="amount">{{$income->amount}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
