<div class="header">
    Modifier l'opération récurrente : {{ $recurrent_transaction->title }}
</div>
<div class="content">
    {!! Form::model($recurrent_transaction, ['method' => 'put', 'route' => ['accounts.recurrent_transactions.update', $recurrent_transaction->account_id, $recurrent_transaction->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.recurrent_transactions.form')
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
