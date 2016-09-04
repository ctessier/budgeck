<div class="form-group">
    {!! Form::label('category_id', 'Catégorie') !!}
    @if (isset($income))
    {!! Form::select('category_id', Budgeck\Models\Category::getList(Budgeck\Models\CategoryType::INCOME)) !!}
    @else
    {!! Form::select('category_id', Budgeck\Models\Category::getList(Budgeck\Models\CategoryType::EXPENSE)) !!}
    @endif
</div>
