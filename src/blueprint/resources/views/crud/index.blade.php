@extends('bp::layout.master')

@section('title'):: Dashboard @stop

@section('content')
    @include('bp::partials.header')

    @include('bp::partials.aside')

    <section class="content">
        <h2>{{ $data->class->title }}</h2>

        <table>
            <thead>
                <tr>
                    <td class="controls" colspan="{{ $data->class->readable_properties_count + 1 }}">
                        <a href="{{ route('bp.res.' . $data->class->route . '.create') }}"
                           class="button button-main">
                            <span class="material-icons">add</span>&nbsp;&nbsp;
                            Создать
                        </a>

                        {!! $data->paginator->render() !!}
                    </td>
                </tr>
                <tr>
                    @foreach($data->class->readable_properties as $property)
                        <td @if($property->width) style="width: {{ $property->width }}px" @endif >

                            @if($property->sortable)
                                <a class="sortable" href="{{ route('bp.res.' . $data->class->route . '.index', [
                                    'orderBy'   => $property->name,
                                    'sort'      => ($orderBy !== $property->name || $sort !== 'asc') ? 'asc' : 'desc',
                                    'page'      => $page
                                ]) }}">

                                    {{ $property->title }}

                                    @if($orderBy === $property->name)
                                        @if ($sort === 'asc')
                                            <span class="icon material-icons">arrow_drop_down</span>
                                        @else
                                            <span class="icon material-icons">arrow_drop_up</span>
                                        @endif
                                    @else
                                        <span class="icon material-icons">import_export</span>
                                    @endif
                                </a>
                            @else
                                {{ $property->title }}
                            @endif

                        </td>
                    @endforeach

                    <td class="no-border">&nbsp;</td>
                </tr>
            </thead>

            <tbody>
                @foreach($data->items as $item)
                    <tr>
                        @foreach($item->readable_properties as $prop)
                            <td>
                                {!! $prop->read() !!}
                            </td>
                        @endforeach
                        <td class="controls">
                            <nav class="button-group" style="width: 90px;">

                                <a href="{{ route('bp.res.' . $data->class->route . '.edit', [
                                    'resource' => urlencode($item->primary_key->value)
                                ]) }}" class="button">

                                    <span class="icon material-icons">create</span>

                                </a>


                                <form action="{{ route('bp.res.' . $data->class->route . '.destroy', [
                                    'resource' => urlencode($item->primary_key->value)
                                ]) }}" method="POST">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="_method" value="DELETE" />

                                    <button type="submit" class="button button-main">
                                        <span class="icon material-icons">clear</span>
                                    </button>
                                </form>

                            </nav>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="{{ $data->class->readable_properties_count + 1 }}">
                        {!! $data->paginator->render() !!}

                        <div class="items-count">
                            Страница <span class="label-info">{{ $data->paginator->currentPage() }}/{{ $data->paginator->lastPage() }}</span>.
                            Всего <span class="label-info">{{ $data->paginator->total() }}</span> элемент
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </section>
@stop