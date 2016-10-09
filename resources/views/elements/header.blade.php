@include('menu.default')

@if (isset($user) && !starts_with(Route::currentRouteName(), 'profile') && !starts_with(Route::currentRouteName(), 'accounts'))
<!--<div id="current-account">
    <div class="row">
        <div class="columns small-12">
            <p>Compte sélectionné : {{$current_account->name}} (@amount($current_account->getBalance()))</p>
        </div>
    </div>
</div>-->
@endif
