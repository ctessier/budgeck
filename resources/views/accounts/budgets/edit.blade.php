<div class="header">
    Modifier le budget {{ $budget->title }}
</div>
<div class="content">
    {!! Form::model($budget, ['method' => 'put', 'route' => ['accounts.budgets.update', $current_account->id, $budget->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.budgets.form')
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
