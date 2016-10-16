<div id="category-selector" class="ui selection dropdown">
    {!! Form::hidden($categoryFieldName) !!}
    <i class="dropdown icon"></i>
    <div class="default text">Sélectionner une catégorie</div>
    <div class="menu">
        @foreach ($categoryArray as $key => $value)
            <div class="item">
                <i class="dropdown icon"></i>
                {{ $key }}
                <div class="menu">
                    @foreach ($value as $key => $category_name)
                        <div class="item" data-value="{{ $key }}">{{ $category_name }}</div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    $('#category-selector').dropdown();
</script>
