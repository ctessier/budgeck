{{--*/ $month = isset($transaction) ? $transaction->month : Carbon\Carbon::now()->month /*--}}
{{--*/ $year = isset($transaction) ? $transaction->year : Carbon\Carbon::now()->year /*--}}
{{--*/ $baseTime = isset($transaction) ? $transaction->created_at : Carbon\Carbon::now() /*--}}
<div class="ui buttons">
    @for ($i = $baseTime->month - config('budgeck.aheadness') ; $i <= $baseTime->month + config('budgeck.aheadness') ; ++$i)
        {{--*/ $currentTime = \Carbon\Carbon::createFromDate($baseTime->year, $i, 1) /*--}}
        <a class="month-selector ui small blue button {{ ($currentTime->month === $month && $currentTime->year === $year) ? 'active' : '' }}" data-month="{{ $currentTime->month }}" data-year="{{ $currentTime->year }}">{{ ucfirst($currentTime->formatLocalized('%B')) }}</a>
    @endfor
</div>

{!! Form::hidden('month', $month, ['data-month' => 'true']) !!}
{!! Form::hidden('year', $year, ['data-year' => 'true']) !!}

<script>
    var currentYear, currentMonth;
    var monthField = $('input[data-month="true"]');
    var yearField = $('input[data-year="true"]');
    $('.month-selector').click(function (e) {
        currentYear = $(this).attr('data-year');
        currentMonth = $(this).attr('data-month');
        monthField.val(currentMonth);
        yearField.val(currentYear);
        $('.month-selector').removeClass('active');
        $(this).addClass('active');
    });
</script>
