@php
    $currentPage = $paginator->currentPage();
    $perPage = $paginator->perPage();
    $total = $paginator->total();
    $start = ($currentPage - 1) * $perPage + 1;
    $end = $currentPage * $perPage > $total ? $total : $currentPage * $perPage;
@endphp

<div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
    <div class="text-muted text-center text-sm-start">
        {{ __('pagination.metronic.showing') }} <span class="fw-bold">{{ $start }}</span> - <span class="fw-bold">{{ $end }}</span> / <span class="fw-bold">{{ $total }}</span> {{ __('pagination.metronic.records') }}
    </div>

    <ul class="pagination pagination-outline flex-wrap justify-content-center m-0">
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() ?? '#' }}">
                <i class="ki-duotone ki-left fs-2"></i>
            </a>
        </li>

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i == $currentPage)
                <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
            @elseif ($i === 1 || $i === $paginator->lastPage() || ($i >= $currentPage - 1 && $i <= $currentPage + 1))
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @elseif ($i == 2 || $i == $paginator->lastPage() - 1)
                <li class="page-item disabled"><a class="page-link">...</a></li>
            @endif
        @endfor

        <li class="page-item {{ $currentPage == $paginator->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() ?? '#' }}">
                <i class="ki-duotone ki-right fs-2"></i>
            </a>
        </li>
    </ul>
</div>
