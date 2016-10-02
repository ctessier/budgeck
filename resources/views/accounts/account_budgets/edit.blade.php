<div class="header">
    Modifier le budget : {{ $account_budget->title }}
</div>
<div class="content">
    {!! Form::model($account_budget, ['method' => 'put', 'route' => ['accounts.account_budgets.update', $account->id, $account_budget->id], 'data-ajax-form' => 'true']) !!}
    @include('accounts.account_budgets.form')
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
