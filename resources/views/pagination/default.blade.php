<div class="dataTable-pagination">
    @if ($paginator->currentPage() > 1)
        <a class="page-item" href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
    @else
        <a class="page-item disabled">&laquo;</a>
    @endif

    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        @if ($i == $paginator->currentPage())
            <a class="phan-trang-fill">{{ $i }}</a>
        @elseif ($i + 3 == 6 && $paginator->currentPage() == 1)
            <a class="phan-trang" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @elseif ( $paginator->currentPage() + 3 > $paginator->lastPage() && $paginator->lastPage() - $i == 2)
            <a class="phan-trang" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @elseif ($i > $paginator->currentPage() - 2 && $i < $paginator->currentPage() + 2)
            <a class="phan-trang" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @endif
    @endfor

    @if ($paginator->currentPage() < $paginator->lastPage())
        <a class="page-item" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
    @else
        <a class="page-item disabled">&raquo;</a>
    @endif
</div>
