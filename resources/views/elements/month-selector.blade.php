<div class="form-group month-selector">
    @for ($i = $baseMonth-config('budgeck.aheadness') ; $i <= $baseMonth+config('budgeck.aheadness') ; ++$i)
        {{--*/ $month = \Carbon\Carbon::createFromDate($baseYear, $i, null) /*--}}
        <a class="{{ (isset($transaction) && $month->month === $transaction->month) || (!isset($transaction) && $month->month == $baseMonth) ? 'selected' : '' }}" data-month="{{ $month->month }}" data-year="{{ $month->year }}">{{ ucfirst($month->formatLocalized('%B')) }}</a>
    @endfor
    {!! Form::hidden('month', isset($transaction) ? $transaction->month : $baseMonth, ['data-month' => 'true']) !!}
    {!! Form::hidden('year', isset($transaction) ? $transaction->year : $baseYear, ['data-year' => 'true']) !!}
</div>
