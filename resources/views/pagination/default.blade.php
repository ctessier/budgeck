@if ($paginator->lastPage() > 1)
<div class="row">
    <div class="ui pagination menu">
        <a class="item {{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}" href="{{ $paginator->url(1) }}">
            <i class="chevron left icon"></i>
        </a>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a class="item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @endfor
        <a class="item {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage() + 1) }}" >
            <i class="chevron right icon"></i>
        </a>
    </div>
</div>
@endif
