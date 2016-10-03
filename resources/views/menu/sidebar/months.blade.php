<div class="four wide column">
    <div class="ui styled fluid accordion">
        {{--*/ $date = Carbon\Carbon::now()->addMonth(config('budgeck.aheadness')) /*--}}
        {{--*/ $currentYear = $date->year /*--}}
        <div class="title {{($date->year == $year) ? ' active' : ''}}">
            <i class="dropdown icon"></i>
            {{$currentYear}}
        </div>
        <div class="content {{($date->year == $year) ? ' active' : ''}}">
            <div class="ui link list">
            @while ($date >= $current_account->created_at)
                @if ($currentYear != $date->year)
                    {{--*/ $currentYear = $date->year /*--}}
                        </div>
                    </div>
                    <div class="title {{($date->year == $year) ? ' active' : ''}}">
                        <i class="dropdown icon"></i>
                        {{$currentYear}}
                    </div>
                    <div class="content {{($date->year == $year) ? ' active' : ''}}">
                        <div class="ui link list">
                @endif
                <a href="{{url('monitoring', ['year' => $date->year, 'month' => $date->month])}}" class="item {{($date->year == $year && $date->month == $month) ? ' active' : ''}}">{{ucfirst($date->formatLocalized('%B'))}}</a>
                {{--*/ $date = $date->subMonths(1) /*--}}
            @endwhile
            </div>
        </div>
    </div>
</div>
<script>
    $('.accordion').accordion();
</script>
