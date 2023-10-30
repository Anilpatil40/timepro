@if ($type)
    <button type="{{$type}}" class="btn btn-primary p-3" style="width: 300px">
        {{ $slot}}
    </button>
@else
    <a href="{{$href}}" class="btn btn-primary p-3" style="width: 300px">
        {{ $slot}}
    </a>
@endif
