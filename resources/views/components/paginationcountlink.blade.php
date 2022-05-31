@if ($paginator->items())
    <ul >
        <li ><span>{{__('Total result')}}: </span><span>{{ $paginator->total() }}</span></li>
        <li><span>{{__('Total of current page')}}: </span><span>{{ $paginator->count() }}</span></li>
    </ul>

@endif
