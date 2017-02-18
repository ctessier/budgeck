<div class="header">
    Nouvelle opération récurrente
</div>
<div class="content">
    {!! Form::open(['method' => 'post', 'route' => ['accounts.recurrent_transactions.store', $current_account->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.recurrent_transactions.form')
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
