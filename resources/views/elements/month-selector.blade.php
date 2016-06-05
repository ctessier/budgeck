{{--*/ $month = isset($transaction) ? $transaction->month : Carbon\Carbon::now()->month /*--}}
{{--*/ $year = isset($transaction) ? $transaction->year : Carbon\Carbon::now()->year /*--}}
{{--*/ $baseTime = isset($transaction) ? $transaction->created_at : Carbon\Carbon::now() /*--}}
<div class="form-group month-selector">
    @for ($i = $baseTime->month - config('budgeck.aheadness') ; $i <= $baseTime->month + config('budgeck.aheadness') ; ++$i)
        {{--*/ $currentTime = \Carbon\Carbon::createFromDate($baseTime->year, $i, 1) /*--}}
        <a class="{{ ($currentTime->month === $month && $currentTime->year === $year) ? 'selected' : '' }}" data-month="{{ $currentTime->month }}" data-year="{{ $currentTime->year }}">{{ ucfirst($currentTime->formatLocalized('%B')) }}</a>
    @endfor
    {!! Form::hidden('month', $month, ['data-month' => 'true']) !!}
    {!! Form::hidden('year', $year, ['data-year' => 'true']) !!}
</div>
