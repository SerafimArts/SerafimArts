<a href="{{ route('bp.res.' . $meta->route . '.show', ['resource' => $value[$meta->primaryKey]]) }}">
    {{ $value[$meta->field] or null }}
</a>