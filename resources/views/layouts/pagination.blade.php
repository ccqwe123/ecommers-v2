@if ($paginator->hasPages())
<div class="wrap-pagination-info">
    <ul class="page-numbers">
         @if ($paginator->onFirstPage())
        @else
            <li><a class="page-number-item next-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Back</a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span class="page-number-item">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><span  class="page-number-item current">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="page-number-item">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
         @if ($paginator->hasMorePages())
            <li><a class="page-number-item next-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
        @else
            <li class="disabled"><span class="page-number-item next-link">Next</span></li>
        @endif
    </ul>
    <p class="result-count">Showing {{ $paginator->currentPage()."-".$paginator->lastPage() }} of {{ $paginator->total() }} result</p>
</div>
@endif