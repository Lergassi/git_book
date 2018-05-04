@extends('layouts.main')

@section('content')
    <div class="block block_border-primary">
        <div class="block__title">title</div>
        <div class="block__content">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="input-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="label">Логин</label>
                    <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="label">Email</label>
                    <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required>
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
                    <label for="password-confirm" class="label">Повторить пароль</label>
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                </div>

                <div class="input-group">
                    <button type="submit" class="btn btn_primary">
                        Регистрация
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
