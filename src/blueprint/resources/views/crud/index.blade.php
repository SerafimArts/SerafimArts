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
                    <td class="controls" colspan="{{ $data->class->fields + 1 }}">
                        <a href="#" class="button button-main">
                            <span class="fa fa-plus"></span>
                            Создать
                        </a>
                    </td>
                </tr>
                <tr>
                    @foreach($data->class->titles as $title)
                        <td>{{ $title }}</td>
                    @endforeach

                    <td>&nbsp;</td>
                </tr>
            </thead>

            <tbody>
                @foreach($data->items as $item)
                    <tr>
                        @foreach($item->properties as $prop)
                            <td>
                                {!! $prop->read() !!}
                            </td>
                        @endforeach
                        <td class="controls">
                            <nav class="button-group">
                                <a href="#" class="button">
                                    <span class="fa fa-pencil"></span>
                                </a>
                                <a href="#" class="button button-main">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </nav>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="{{ $data->class->fields + 1 }}">
                    {!! $data->paginator->render() !!}

                    <div class="label items-count">
                        Всего {{ $data->paginator->total() }} элемент
                    </div>
                </td>
            </tfoot>
        </table>

    </section>
@stop