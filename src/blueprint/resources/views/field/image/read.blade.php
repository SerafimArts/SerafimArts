<figure style="width: {{ $meta->width }}px; height: {{ $meta->height }}px">
    @if($value)
        <img src="{{ $value }}" alt="{{ $name }}" />
    @else
        <img src="{{ route('bp.asset', ['file' => 'user.png']) }}" alt="{{ $name }}" />
    @endif
</figure>
