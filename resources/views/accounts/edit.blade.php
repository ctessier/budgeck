{!! Form::model($account, ['method' => 'put', 'route' => ['accounts.update', $account->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    @include('accounts.form')
    {!! Form::button('Sauvegarder', ['type' => 'submit', 'class' => 'ui blue button', 'data-form-submit' => 'true']) !!}
{!! Form::close() !!}
