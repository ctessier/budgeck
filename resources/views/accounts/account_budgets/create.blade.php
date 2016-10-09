<div class="header">
    Nouveau budget pour {{ $account->name }}
</div>
<div class="content">
    {!! Form::open(['method' => 'post', 'route' => ['accounts.account_budgets.store', $account->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.account_budgets.form')
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
