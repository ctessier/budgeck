<div id="category-selector" class="ui selection dropdown">
    {!! Form::hidden($categoryFieldName) !!}
    <i class="dropdown icon"></i>
    <div class="default text">Sélectionner une catégorie</div>
    <div class="menu">
        @foreach ($categoryArray as $category)
            <div class="item" data-value="{{ $category->id }}">
                {{ $category->name }}
                @if (count($category->children) > 0)
                <i class="dropdown icon"></i>
                <div class="menu">
                    @foreach ($category->children as $childCategory)
                        <div class="item" data-value="{{ $childCategory->id }}">{{ $childCategory->name }}</div>
                    @endforeach
                </div>
                @endif
            </div>
        @endforeach
    </div>

</div>

<script>
    $('#category-selector').categorySelector();
</script>
