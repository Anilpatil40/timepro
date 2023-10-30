<a class="card p-3 text-decoration-none" style="" href="{{ $href }}">
    <div class="d-flex align-items-center">
        <div class="bg-danger text-light d-flex justify-content-center align-items-center"
            style="border-radius: 50%;width: 60px;height: 60px;">
            <i class="bi bi-{{ $icon }}" style="font-size: 20px;"></i>
        </div>
        <h4 class="m-0 ms-3" style="font-weight: 600;">{{ $header }}</h4>
    </div>
    @if ($slot)
        <span class="mt-3" style="font-size: 16px">
            {{ $slot }}
        </span>
    @endif
</a>
