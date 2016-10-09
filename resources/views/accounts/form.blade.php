<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('name', 'Nom du compte') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('name', null, ['placeholder' => 'Nom du compte']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('description') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('description', null, ['placeholder' => 'Description...']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('account_type_id', 'Type de compte') !!}
    </div>
    <div class="six wide column field">
        {!! Form::select('account_type_id', Budgeck\Models\AccountType::lists('name', 'id'), null, ['class' => 'ui selection dropdown']) !!}
    </div>
</div>

<script>
    $('.dropdown').dropdown();
</script>
