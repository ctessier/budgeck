<header>
    <div id="topbar">
        <div class="row">
            <div class="columns small-3">
                <a href="{{url('/')}}" class="logo">{{ Config::get('budgeck.appName') }} <span class="version">bêta</span></a>
            </div>
            <div class="columns small-9">
                @include('menu.default')
            </div>
        </div>
    </div>
    @if (isset($user) && !starts_with(Route::currentRouteName(), 'profile') && !starts_with(Route::currentRouteName(), 'accounts'))
    <div id="current-account">
        <div class="row">
            <div class="columns small-12">
                <p>Compte sélectionné : {{$current_account->name}} (@amount($current_account->getBalance()))</p>
            </div>
        </div>
    </div>
    @endif
</header>
