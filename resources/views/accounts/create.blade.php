<div class="header">
    Ajouter un compte
</div>
<div class="content">
    {!! Form::open(['method' => 'post', 'route' => ['accounts.store', null], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.form')
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>
{!! Form::close() !!}
