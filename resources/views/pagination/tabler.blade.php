@php
    $currentPage = $paginator->currentPage();
    $perPage = $paginator->perPage();
    $total = $paginator->total();
    $start = ($currentPage - 1) * $perPage + 1;
    $end = $currentPage * $perPage > $total ? $total : $currentPage * $perPage;
@endphp

<p class="m-0 text-secondary">
    Hiển thị <span>{{ $start }}</span> - <span>{{ $end }}</span> / <span>{{ $total }} bản ghi.</span>
</p>

<ul class="pagination m-0 ms-auto">
    @if ($paginator->currentPage() > 1)
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg></a>
      </li>
    @else
    <li class="page-item disabled">
        <a class="page-link" tabindex="-1" aria-disabled="true">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg></a>
      </li>
    @endif

    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        @if ($i == $paginator->currentPage())
        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
        @elseif ($i + 3 == 6 && $paginator->currentPage() == 1)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @elseif ( $paginator->currentPage() + 3 > $paginator->lastPage() && $paginator->lastPage() - $i == 2)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @elseif ($i > $paginator->currentPage() - 2 && $i < $paginator->currentPage() + 2)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
    @endfor

    @if ($paginator->currentPage() < $paginator->lastPage())
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
        </a>
    </li>
    @else
    <li class="page-item disabled">
      <a class="page-link">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
      </a>
    </li>
    @endif
  </ul>