<nav>
    <ul class="right">
        @if (Auth::check())
            @include('menu.authenticated')
        @else
            @include('menu.non-authenticated')
        @endif
    </ul>
</nav>
