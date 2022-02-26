@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>

        <ul class="mt-3 px-4 list-disc list-inside text-sm text-white-600 alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
