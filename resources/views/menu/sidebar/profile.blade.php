<div class="columns large-4">
    <ul class="tabs">
        <li class="{!! (Route::currentRouteNamed('profile')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('profile', 'Mon profil') !!}
        </li>
        <li class="{!! (Route::currentRouteNamed('accounts')) ? 'active' : '' !!}">
            {!! HTML::linkRoute('accounts', 'Mes comptes') !!}
        </li>
        @if (Route::currentRouteNamed('accounts'))
        <ul>
            @foreach ($user->accounts as $account)
            <li>{{$account->name}}</li>
            @endforeach
        </ul>
        @endif
    </ul>
</div>
