<aside class="nav">
    <nav>
        <h4>Навигация</h4>

        @foreach($bp as $meta)
            <a href="{{ route('bp.res.' . $meta->class->route . '.index') }}">
                @if ($meta->class->icon)
                    <span class="fa fa-{{ $meta->class->icon }}"></span>
                @endif
                {{ $meta->class->title }}
            </a>
        @endforeach
    </nav>

</aside>