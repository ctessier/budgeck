<header>
    <div class="row">
        <div class="columns small-3">
            <a href="{{url('/')}}" class="logo">{{ Config::get('budgeck.appName') }} <span class="version">bêta</span></a>
        </div>
        <div class="columns small-9">
            @include('menu.default')
        </div>
    </div>
</header>
