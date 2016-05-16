<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('title', 'Nom du budget') !!}
            {!! Form::text('title', null, ['placeholder' => 'Nom du budget...']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('description') !!}
            {!! Form::text('description', null, ['placeholder' => 'Description...']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('amount', 'Montant') !!}
            {!! Form::text('amount', null, ['placeholder' => 'Montant...']) !!}
        </div>
    </div>
    <div class="columns large-6">
        <div class="form-group">
            {!! Form::label('Catégorie par défaut') !!}
            {!! Form::select('default_category_id') !!}
        </div>
    </div>
</div>
{!! Form::hidden('month', $month) !!}
{!! Form::hidden('year', $year) !!}
