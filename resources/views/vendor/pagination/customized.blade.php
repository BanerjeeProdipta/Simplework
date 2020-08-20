<!DOCTYPE html>
<html>
<head>
<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a.active {
  background-color: cornflowerblue;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

</style>
</head>

<body>

<div class="pagination">
   
  <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
  {{-- Pagination Elements --}}
  @foreach ($elements as $element)

  {{-- Array Of Links --}}
    @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                <a class="page-link active" aria-current="page">{{ $page }}</a>
            @else
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach
    @endif
  @endforeach
  <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
               
</div>

</body>
</html>
