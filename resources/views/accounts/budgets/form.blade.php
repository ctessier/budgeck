<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('title', 'Titre') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('title', null, ['placeholder' => 'Titre du budget']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('description') !!}
    </div>
    <div class="six wide column field">
        {!! Form::text('description', null, ['placeholder' => 'Description du budget']) !!}
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('amount', 'Montant') !!}
    </div>
    <div class="six wide column field">
        <div class="ui right labeled input">
            {!! Form::text('amount', null, ['placeholder' => '12.34']) !!}
            <div class="ui basic label">
                &euro;
            </div>
        </div>
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        {!! Form::label('default_category_id', 'Catégorie par défaut') !!}
    </div>
    <div class="six wide column field">
        {{--*/ $categoryArray = Budgeck\Models\Category::getList(Budgeck\Models\CategoryType::EXPENSE) /*--}}
        {{--*/ $categoryFieldName = "default_category_id" /*--}}
        @include('elements.category-selector')
    </div>
</div>
<div class="ui grid inline fields">
    <div class="three wide column field">
        <label>Clôturer</label>
    </div>
    <div class="six wide column field">
        <div class="ui toggle checkbox">
            {!! Form::checkbox('closed', true, false, ['id' => 'closed']) !!}
            {!! Form::label('closed', 'Clôturer le budget') !!}
        </div>
    </div>
</div>

{!! Form::hidden('year', $year) !!}
{!! Form::hidden('month', $month) !!}

<script>
    $('.dropdown').dropdown();
</script>
