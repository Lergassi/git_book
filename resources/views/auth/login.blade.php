@extends('layouts.main')

@section('content')
    <div class="block block_border-info">
        <div class="block__title">title</div>
        <div class="block__content">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="label">Email</label>
                    <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="label">Пароль</label>
                    <input id="password" type="password" class="input" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить?
                </div>

                <div class="input-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn_primary">
                            Вход
                        </button>
                        <a class="btn btn_danger" href="{{ route('password.request') }}">Забыли пароль?</a>
                        <a class="btn btn_warning" href="{{ route('register') }}">Регистрация</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
