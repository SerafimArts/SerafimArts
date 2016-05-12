@if($meta->maxSize && mb_strlen($value) > $meta->maxSize)
    {{ mb_substr($value, 0, $meta->maxSize) }}&hellip;
@else
    {{ $value }}
@endif