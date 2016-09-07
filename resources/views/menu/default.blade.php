<div class="ui top fixed menu">
    <div class="ui container">
        <div class="header item">
            {!! HTML::image('/images/logo.png', 'B') !!}
        </div>
        @if (Auth::check())
            @include('menu.authenticated')
        @else
            @include('menu.non-authenticated')
        @endif
    </div>
</div>
