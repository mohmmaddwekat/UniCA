@if ($paginator->items())
    <ul >
        <li ><span>Total result: </span><span>{{ $paginator->total() }}</span></li>
        <li><span>Total of current page: </span><span>{{ $paginator->count() }}</span></li>
    </ul>

@endif
