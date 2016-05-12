<aside class="nav">
    <nav>
        <h4>Навигация</h4>

        @foreach($bp as $meta)
            <a href="{{ route('bp.res.' . $meta->class->route . '.index') }}"
               title="{{ $meta->class->title }}"
               class="{{ $route === 'bp.res.' . $meta->class->route . '.index' ? 'active' : '' }}">
                @if ($meta->class->icon)
                    <span class="icon material-icons">{{ $meta->class->icon }}</span>
                @endif
                {{ $meta->class->title }}
            </a>
        @endforeach
    </nav>

</aside>