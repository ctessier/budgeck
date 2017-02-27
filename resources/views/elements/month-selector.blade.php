{{--*/ $month = isset($transaction) ? $transaction->month : (isset($budget) ? $budget->month : Carbon\Carbon::now()->month) /*--}}
{{--*/ $year = isset($transaction) ? $transaction->year : (isset($budget) ? $budget->year : Carbon\Carbon::now()->year) /*--}}
{{--*/ $baseTime = isset($transaction) ? $transaction->created_at : Carbon\Carbon::now() /*--}}
<div id="month-selector" class="ui buttons">
    @for ($i = $baseTime->month - config('budgeck.aheadness') ; $i <= $baseTime->month + config('budgeck.aheadness') ; ++$i)
        {{--*/ $currentTime = \Carbon\Carbon::createFromDate($baseTime->year, $i, 1) /*--}}
        <a class="ui small blue button {{ ($currentTime->month == $month && $currentTime->year == $year) ? 'active' : '' }} month" data-month="{{ $currentTime->month }}" data-year="{{ $currentTime->year }}">{{ ucfirst($currentTime->formatLocalized('%B')) }}</a>
    @endfor
</div>

{!! Form::hidden('month', $month, ['data-month' => 'true']) !!}
{!! Form::hidden('year', $year, ['data-year' => 'true']) !!}
