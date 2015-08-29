<nav>
    <div class="row">
        <div class="columns large-12">
            <ul class="right">
                @if (Auth::check())
                <li>
                    {!! HTML::linkRoute('logout', 'Déconnexion') !!}
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>