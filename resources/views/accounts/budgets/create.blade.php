<div class="header">
    Nouveau budget pour {{ $month }}/{{ $year }}
</div>
<div class="content">
    {!! Form::open(['method' => 'post', 'route' => ['accounts.budgets.store', $current_account->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.budgets.form')
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
