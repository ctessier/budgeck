<div id="category-selector" class="ui dropdown selection">
    {!! Form::hidden($categoryFieldName) !!}
    <span class="text">Sélectionner une catégorie</span>
    <i class="dropdown icon"></i>
    <div class="menu">
        @foreach ($categoryArray as $category)
            <div class="item" data-value="{{ $category->id }}">
                @if (count($category->children) > 0)
                <i class="dropdown icon"></i>
                <span class="text">{{ $category->name }}</span>
                <div class="menu">
                    @foreach ($category->children as $childCategory)
                        <div class="item" data-value="{{ $childCategory->id }}">{{ $childCategory->name }}</div>
                    @endforeach
                </div>
                @else
                <span class="text">{{ $category->name }}</span>
                @endif
            </div>
        @endforeach
    </div>

</div>

<script>
    $('#category-selector').categorySelector();
</script>
