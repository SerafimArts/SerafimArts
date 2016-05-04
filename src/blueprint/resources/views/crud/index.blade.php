@extends('bp::layout.master')

@section('title'):: Dashboard @stop

@section('content')
    @include('bp::partials.header')

    @include('bp::partials.aside')

    <section class="content">

        <h2>{{ $meta->class->title }}</h2>

        <table>
            <thead>
                <tr>
                    <td class="controls" colspan="{{ count($meta->properties) + 1 }}">
                        <a href="#" class="button button-main">
                            <span class="fa fa-plus"></span>
                            Создать
                        </a>
                    </td>
                </tr>
                <tr>
                    @foreach($meta->properties as $prop)
                        <td>{{ $prop->title }}</td>
                    @endforeach
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
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
                <td colspan="{{ count($meta->properties) + 1 }}">
                    {!! $items->render() !!}

                    <div class="label items-count">
                        Всего {{ $items->total() }} элемент
                    </div>
                </td>
            </tfoot>
        </table>

    </section>
@stop