<div class="form-group">
    {!! Form::label('name', 'Nom du compte') !!}
    {!! Form::text('name', null, ['placeholder' => 'Nom du compte...']) !!}
</div>
<div class="form-group">
    {!! Form::label('description') !!}
    {!! Form::text('description', null, ['placeholder' => 'Description...']) !!}
</div>
<div class="form-group">
    {!! Form::label('account_type_id', 'Type de compte') !!}
    {!! Form::select('account_type_id', Budgeck\Models\AccountType::lists('name', 'id')) !!}
</div>
