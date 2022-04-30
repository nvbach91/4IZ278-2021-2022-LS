<div class="row">
    <div class="col">
        <nav>
            <ul class="pagination justify-content-center">
                @php($range = 4)
                @php($rangeStart = $paginator->currentPage() - $range <= 1 ? 1 : $paginator->currentPage() - $range)
                @php($rangeEnd = $paginator->currentPage() + $range >= $paginator->lastPage() ? $paginator->lastPage() : $paginator->currentPage() + $range)

                @if($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link disabled" tabindex="-1" disabled href="#" aria-disabled="true">
                            {{ __('tables.pagination.previous') }}
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl()	 }}">
                            {{ __('tables.pagination.previous') }}
                        </a>
                    </li>
                @endif

                @if($paginator->currentPage() === 1)
                    <li class="page-item disabled">
                        <a class="page-link" tabindex="-1" disabled href="#" aria-disabled="true">
                            <i class="bi bi-chevron-double-left"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}">
                            <i class="bi bi-chevron-double-left"></i>
                        </a>
                    </li>
                @endif

                @foreach($paginator->getUrlRange($rangeStart, $rangeEnd) as $page => $link)
                    <li class="page-item {{ $page === $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $link }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach

                @if($paginator->currentPage() === $paginator->lastPage())
                    <li class="page-item disabled">
                        <a class="page-link" tabindex="-1" disabled href="#" aria-disabled="true">
                            <i class="bi bi-chevron-double-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">
                            <i class="bi bi-chevron-double-right"></i>
                        </a>
                    </li>
                @endif

                @if($paginator->currentPage() === $paginator->lastPage())
                    <li class="page-item disabled">
                        <a class="page-link disabled" tabindex="-1" disabled href="#" aria-disabled="true">
                            {{ __('tables.pagination.next') }}
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl()	 }}">
                            {{ __('tables.pagination.next') }}
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>