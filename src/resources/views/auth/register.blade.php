@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login">
    <h2 class="login__title">会員登録</h2>

    <form class="login-form" action="/register" method="post">
        @csrf

        <div class="login-form__group">
            <label class="login-form__label">お名前</label>
            <input class="login-form__input" type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="login-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="login-form__group">
            <label class="login-form__label">メールアドレス</label>
            <input class="login-form__input" type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="login-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="login-form__group">
            <label class="login-form__label">パスワード</label>
            <input class="login-form__input" type="password" name="password">
            @error('password')
                <p class="login-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="login-form__group">
            <label class="login-form__label">確認用パスワード</label>
            <input class="login-form__input" type="password" name="password_confirmation">
        </div>

        <button class="login-form__button" type="submit">登録する</button>
    </form>

    <div class="login__link-wrap">
        <a class="login__link" href="/login">ログインはこちら</a>
    </div>
</div>
@endsection