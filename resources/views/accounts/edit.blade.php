{!! Form::model($account, ['method' => 'put', 'route' => ['accounts.update', $account->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    <div class="ui grid inline fields">
        <div class="three wide column field">
            {!! Form::label('name', 'Nom du compte') !!}
        </div>
        <div class="six wide column field">
            {!! Form::text('name') !!}
        </div>
    </div>
    <div class="ui grid inline fields">
        <div class="three wide column field">
            {!! Form::label('description', 'Description') !!}
        </div>
        <div class="six wide column field">
            {!! Form::text('description') !!}
        </div>
    </div>
    <div class="ui grid inline fields">
        <div class="three wide column field">
            {!! Form::label('account_type_id', 'Type de compte') !!}
        </div>
        <div class="six wide column field">
            {!! Form::select('account_type_id', Budgeck\Models\AccountType::lists('name', 'id'), $account->account_type_id, ['class' => 'ui selection dropdown']) !!}
        </div>
    </div>
    {!! Form::button('Sauvegarder', ['type' => 'submit', 'class' => 'ui blue button', 'data-form-submit' => 'true']) !!}
{!! Form::close() !!}
