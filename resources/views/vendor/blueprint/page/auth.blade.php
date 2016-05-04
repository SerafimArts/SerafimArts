@extends('bp::layout.master')

@section('content')

    <form method="POST" action="{{ route('bp.auth.action') }}" class="auth">
        <h2>Blueprint Admin</h2>

        {{ csrf_field() }}

        @foreach($errors->all() as $error)
            <div class="form-item">
                <label class="label label-error">
                    {{ $error }}
                </label>
            </div>
        @endforeach

        <div class="form-item">
            <input type="text" name="login" placeholder="Login" />
        </div>

        <div class="form-item">
            <input type="password" name="password" placeholder="Password" />
        </div>

        <div class="form-item-x3">
            <button type="submit" class="button button-main">Вход</button>
        </div>
    </form>

@stop