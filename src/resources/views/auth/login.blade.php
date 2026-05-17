@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login">
    <h2 class="login__title">ログイン</h2>

    <form class="login-form" action="/login" method="post">
        @csrf

        <div class="login-form__group">
            <label class="login-form__label" for="email">メールアドレス</label>
            <input class="login-form__input" type="email" name="email" id="email" value="{{ old('email') }}">

            @error('email')
                <p class="login-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="login-form__group">
            <label class="login-form__label" for="password">パスワード</label>
            <input class="login-form__input" type="password" name="password" id="password">

            @error('password')
                <p class="login-form__error">{{ $message }}</p>
            @enderror
        </div>

        <button class="login-form__button" type="submit">ログインする</button>
    </form>

    <div class="login__link-wrap">
        <a class="login__link" href="/register">会員登録はこちら</a>
    </div>
</div>
@endsection