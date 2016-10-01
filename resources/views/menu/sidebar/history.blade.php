<div class="four wide column">
    <div class="ui segment">
        <div class="ui small statistic">
            <div class="label">
                Transactions
            </div>
            <div class="value">
                {{$current_account->hasMany('\Budgeck\Models\Transaction')->count()}}
            </div>
        </div>
    </div>
</div>
