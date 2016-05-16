{!! Form::model($account, ['method' => 'put', 'route' => ['accounts.update', $account->id], 'class' => 'horizontal', 'data-ajax-form' => 'true']) !!}
<div class="row">
    <div class="columns large-3">
        <div class="form-group">
            {!! Form::label('name', 'Nom du compte') !!}
        </div>
    </div>
    <div class="columns large-9">
        <div class="form-group">
            {!! Form::text('name') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-3">
        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
        </div>
    </div>
    <div class="columns large-9">
        <div class="form-group">
            {!! Form::text('description') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-3">
        <div class="form-group">
            {!! Form::label('account_type_id', 'Type de compte') !!}
        </div>
    </div>
    <div class="columns large-9">
        <div class="form-group">
            {!! Form::select('account_type_id', Budgeck\Models\AccountType::lists('name', 'id')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-12">
        <a data-form-submit="true" class="btn-base radius right">Sauvegarder</a>
    </div>
</div>
{!! Form::close() !!}
